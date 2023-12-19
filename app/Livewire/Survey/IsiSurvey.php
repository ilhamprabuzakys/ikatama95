<?php

namespace App\Livewire\Survey;

use App\Models\BaktiPhoto;
use App\Models\BerkaryaPhoto;
use App\Models\KolaseAlbumPhoto;
use App\Models\Survey;
use App\Models\TarunaPhoto;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Facades\Image;
use Karriere\PdfMerge\PdfMerge;

#[Title('Pengisian Survey IKATAMA 95')]
#[Layout('survey.layouts.app')]
class IsiSurvey extends Component
{
    public $survey_id = null;
    public $sudah_mengisi = false;
    public $link_pdf;

    public function mount()
    {
        if ($this->survey_id == null) {
            if (Auth::check()) {
                # Cek apakah dia sudah mengisi survey
                if (Survey::where('user_id', Auth::user()->id)->exists()) {
                    $this->link_pdf = Survey::where('user_id', Auth::user()->id)->first()->file_path;
                    // $this->survey_id = Survey::where('user_id', Auth::user()->id)->first()->id;
                }
            } else {
                $this->link_pdf = '';
            }
        }
    }

    #[On('storeSurvey')]
    public function storeSurvey($results)
    {
        // Dekode hasil JSON
        $data = json_decode($results, true);

        // Cek data json.
        // dd($data);

        $this->saveSurvey($data);
        $this->saveTaruna($data);
        $this->saveTerkini($data);
        $this->saveKeluarga($data);
        $this->saveFotoAnakSemua($data);

        // Foto Kolase Album Taruna
        if (array_key_exists('foto_kolase_album_taruna', $data)) {
            $this->saveImageToMultipleDirectory($data['foto_kolase_album_taruna'], 'foto-kolase-album');
        }
        // Foto Bakti
        if (array_key_exists('foto_bakti_akpol', $data)) {
            $this->saveImageToMultipleDirectory($data['foto_bakti_akpol'], 'foto-bakti');
        }
        // Foto Berkarya
        if (array_key_exists('foto_berkarya_patriatama', $data)) {
            $this->saveImageToMultipleDirectory($data['foto_berkarya_patriatama'], 'foto-berkarya');
        }
        // dd('berhasil..', $data);
        // $this->dispatch('swal:modal', [
        //     'icon' => 'success',
        //     'title' => 'Berhasil!',
        //     'text' => 'Formulir anda berhasil disimpan'
        // ]);

        $this->checkOrCreateAccount();


        if ($this->generatePDF() == false) {
            # code...
            # Set state
            $this->dispatch('surveyCompleted');
            $this->sudah_mengisi = true;
            $this->link_pdf = Survey::find($this->survey_id)->file_path;

            
            
        } else {
            $this->dispatch('swal:loading', [
                'title' => 'Tunggu konversi',
                'text' => 'Menyimpan formulir',
                'icon' => 'info',
            ]);
        }
        // dd($this->link_pdf);
    }

    #[On('checkAccount')]
    public function checkOrCreateAccount()
    {
        if (Auth::check()) {
            return;
        }

        $this->dispatch('swal:loading', [
            'title' => 'Tunggu pembuatan akun',
            'text' => 'Mengecekan pembuatan akun',
            'icon' => 'info',
        ]);

        // $accountIsExist = false;
        $survey = Survey::find($this->survey_id);
        if (!$survey) {
            $this->dispatch('alert', [
                'title' => 'Error',
                'message' => 'Terjadi kesalahan tidak diketahui.',
                'type' => 'error',
            ]);
            return;
        }

        $user_found = User::where('nrp', $survey->nrp)->first();

        if ($user_found) {
            $this->dispatch('alert', [
                'title' => 'Informasi',
                'message' => 'Data user dengan nrp yang anda masukan sudah ada.',
                'type' => 'info',
            ]);
            return;
        }

        try {
            $user = User::create([
                'avatar' => $survey->foto_terkini,
                'pangkat' => $survey->pangkat,
                'phone' => $survey->no_telepon,
                'name' => $survey->nama,
                'nrp' => $survey->nrp,
                'dob' => $survey->tanggal_lahir,
                'role' => 'alumni',
                'email_verified_at' => \now()
            ]);

            $survey->update([
                'user_id' => $user->id
            ]);
    
            $this->dispatch('alert', [
                'title' => 'Berhasil',
                'message' => 'Akun user berhasil dibuat, anda dapat login menggunakan <strong>NRP</strong> dan <strong>tanggal lahir</strong> anda.',
                'type' => 'success',
            ]);
        } catch (ValidationException $th) {
            $this->dispatch('alert', [
                'title' => 'Error',
                'message' => 'Terjadi kesalahan tidak diketahui.',
                'type' => 'error',
            ]);
        }
    }

    public function saveFotoAnakSemua($data)
    {
        // Foto Anak Pertama (jika ada)
        if (array_key_exists('foto_anak_pertama', $data)) {
            $path = $this->saveImageToDirectory($data['foto_anak_pertama'][0], 'foto-anak-pertama');
            Survey::where('id', $this->survey_id)->update(['foto_anak_pertama' => $path]);
        }

        // Foto Anak Kedua (jika ada)
        if (array_key_exists('foto_anak_kedua', $data)) {
            $path = $this->saveImageToDirectory($data['foto_anak_kedua'][0], 'foto-anak-kedua');
            Survey::where('id', $this->survey_id)->update(['foto_anak_kedua' => $path]);
        }

        // Foto Anak Ketiga (jika ada)
        if (array_key_exists('foto_anak_ketiga', $data)) {
            $path = $this->saveImageToDirectory($data['foto_anak_ketiga'][0], 'foto-anak-ketiga');
            Survey::where('id', $this->survey_id)->update(['foto_anak_ketiga' => $path]);
        }

        // Foto Anak Keempat (jika ada)
        if (array_key_exists('foto_anak_keempat', $data)) {
            $path = $this->saveImageToDirectory($data['foto_anak_keempat'][0], 'foto-anak-keempat');
            Survey::where('id', $this->survey_id)->update(['foto_anak_keempat' => $path]);
        }

        // Foto Anak Kelima (jika ada)
        if (array_key_exists('foto_anak_kelima', $data)) {
            $path = $this->saveImageToDirectory($data['foto_anak_kelima'][0], 'foto-anak-kelima');
            Survey::where('id', $this->survey_id)->update(['foto_anak_kelima' => $path]);
        }
    }

    public function saveKeluarga($data)
    {
        $fotoKeluargaFilename = $this->saveImageToDirectory($data['foto_keluarga'][0], 'foto-keluarga');
        // Update kolom foto_keluarga di tabel surveys
        Survey::where('id', $this->survey_id)->update(['foto_keluarga' => $fotoKeluargaFilename]);
    }

    public function saveTaruna($data)
    {
        $fotoTarunaFilename = $this->saveImageToDirectory($data['foto_taruna'][0], 'foto-taruna');
        // Simpan foto_taruna ke tabel taruna_photos
        Survey::where('id', $this->survey_id)->update(['foto_taruna' => $fotoTarunaFilename]);
        TarunaPhoto::create([
            'survey_id' => $this->survey_id,
            'path' => $fotoTarunaFilename
        ]);
    }

    public function saveTerkini($data)
    {
        $fotoTerkiniFilename = $this->saveImageToDirectory($data['foto_terkini'][0], 'foto-profil');

        // Update kolom foto_terkini di tabel surveys
        Survey::where('id', $this->survey_id)->update(['foto_terkini' => $fotoTerkiniFilename]);
    }


    protected function saveImageToDirectory($imageData, $directory)
    {
        $filename = null;
        $namaPengisi = \strtoupper(Str::slug(Survey::find($this->survey_id)->nama));
        $waktuSekarang = str_replace(' ', '_', now());
        $waktuSekarang = str_replace(':', '-', $waktuSekarang);

        $base64Image = $imageData['content'];

        if (Str::startsWith($base64Image, 'data:image')) {
            [$type, $base64Image] = explode(';', $base64Image);
            [, $base64Image]      = explode(',', $base64Image);
            $image = base64_decode($base64Image);

            $filename = $namaPengisi . '_' . $waktuSekarang . '_' . \random_int(333, 10000) . '.jpg';

            $img = Image::make($image);

            // Opsi 1: Mengurangi dimensi gambar menjadi setengah dengan aspek rasio yang tetap
            // $width = $img->width() / 2;
            // $height = $img->height() / 2;
            // $img->resize($width, $height);

            // Opsi 2: Kompres gambar dengan kualitas 60% tanpa mengubah dimensinya
            $img->stream('jpg', 60);

            Storage::disk('public')->put('surveys/' . $namaPengisi . '/' . $directory . '/' . $filename, $img);
            $filename = 'storage/surveys/' . $namaPengisi . '/' . $directory . '/' . $filename;
        }

        return $filename;
    }


    protected function saveImageToMultipleDirectory($imageDatas, $directory)
    {
        $savedPaths = [];
        foreach ($imageDatas as $imageData) {
            $path = $this->saveImageToDirectory($imageData, $directory);
            $savedPaths[] = $path;

            // Simpan path ke model yang sesuai berdasarkan direktori
            if ($directory == 'foto-bakti') {
                BaktiPhoto::create([
                    'survey_id' => $this->survey_id,
                    'path' => $path
                ]);
            } elseif ($directory == 'foto-berkarya') {
                BerkaryaPhoto::create([
                    'survey_id' => $this->survey_id,
                    'path' => $path
                ]);
            } elseif ($directory == 'foto-kolase-album') {
                KolaseAlbumPhoto::create([
                    'survey_id' => $this->survey_id,
                    'path' => $path
                ]);
            }
        }
        return $savedPaths;
    }

    protected function saveSurvey($data)
    {
        // Jika user terotentikasi, cek apakah ada survey dengan user_id yang sama
        if (Auth::check()) {
            $oldSurvey = Survey::where('user_id', auth()->id())->first();

            // Jika survey ditemukan, hapus data terkait dan file dari storage
            if ($oldSurvey) {
                // Hapus file dari storage
                $directoriesToDelete = [
                    'foto-keluarga', 'foto-taruna', 'foto-profil',
                    'foto-anak-pertama', 'foto-anak-kedua', 'foto-anak-ketiga',
                    'foto-anak-keempat', 'foto-anak-kelima', 'foto-bakti', 'foto-berkarya'
                ];
                $namaPengisi = strtoupper(Str::slug($oldSurvey->nama));
                // Hapus direktori pengisi beserta isinya secara rekursif
                Storage::disk('public')->deleteDirectory('surveys/' . $namaPengisi);
                /*  foreach($directoriesToDelete as $directory) {
                Storage::disk('public')->deleteDirectory('surveys/' . $namaPengisi . '/' . $directory);
            } */
                // Hapus data dari model terkait
                TarunaPhoto::where('survey_id', $oldSurvey->id)->delete();

                // Hapus data dari model lainnya (gantilah "OtherModel" dengan nama model yang sesuai)
                BaktiPhoto::where('survey_id', $oldSurvey->id)->delete();
                BerkaryaPhoto::where('survey_id', $oldSurvey->id)->delete();

                // Hapus survey lama
                $oldSurvey->delete();
            }
        }


        $pangkat = isset($data['pangkat']) ? $data['pangkat'] : (isset($data['pangkat_lainya']) ? $data['pangkat_lainya'] : null);

        $pangkat = strtoupper(str_replace('_', ' ', $pangkat));

        $status_kedinasan = isset($data['status_kedinasan']) ? $data['status_kedinasan'] : (isset($data['status_kedinasan_lainya']) ? $data['status_kedinasan_lainya'] : null);

        $status_pernikahan = isset($data['status_pernikahan']) ? $data['status_pernikahan'] : (isset($data['status_pernikahan_lainya']) ? $data['status_pernikahan_lainya'] : null);

        $timestamp = Carbon::now();
        // $timestamp = Carbon::now()->format('d/m/Y H:i:s');

        $survey = Survey::create([
            'timestamp' => $timestamp ?? '-',
            'user_id' => Auth::check() ? auth()->id() : null,
            'nama' => \strtoupper($data['nama'] ?? '-'),
            'panggilan' => $data['panggilan'] ?? '-',
            'tempat_lahir' => $data['tempat_lahir'] ?? '-',
            'tanggal_lahir' => $data['tanggal_lahir'] ?? '-',
            'pangkat' => $pangkat ?? '-',
            'nrp' => $data['nrp'] ?? '-',
            'status_kedinasan' => $status_kedinasan ?? '-',
            'status_pernikahan' => $status_pernikahan ?? '-',
            'jumlah_anak' => $data['jumlah_anak'] ?? NULL,
            'no_telepon' => $data['no_telepon'] ?? NULL,
            'email' => $data['email'] ?? NULL,
            'alamat' => $data['alamat'] ?? NULL,
            'motto' => $data['motto'] ?? NULL,
            'narasi_personal' => $data['narasi_personal'] ?? NULL,
            'narasi_keluarga' => $data['narasi_keluarga'] ?? NULL,
            'nama_bakti' => $data['nama_bakti'] ?? NULL,
            'narasi_bakti' => $data['narasi_bakti_akpol'] ?? NULL,
            'nama_karya' => $data['nama_karya'] ?? NULL,
            'narasi_karya' => $data['narasi_berkarya_untuk_patriatama'] ?? NULL,
            'nama_anak_pertama' => \strtoupper($data['nama_anak_pertama'] ?? NULL),
            'tempat_lahir_anak_pertama' => $data['tempat_lahir_anak_pertama'] ?? NULL,
            'tanggal_lahir_anak_pertama' => $data['tanggal_lahir_anak_pertama'] ?? NULL,
            'jenis_kelamin_anak_pertama' => $data['jenis_kelamin_anak_pertama'] ?? NULL,
            'pekerjaan_anak_pertama' => $data['pekerjaan_anak_pertama'] ?? NULL,
            'alamat_anak_pertama' => $data['alamat_anak_pertama'] ?? NULL,
            'motto_anak_pertama' => $data['motto_anak_pertama'] ?? NULL,
            'nama_anak_kedua' => \strtoupper($data['nama_anak_kedua'] ?? NULL),
            'tempat_lahir_anak_kedua' => $data['tempat_lahir_anak_kedua'] ?? NULL,
            'tanggal_lahir_anak_kedua' => $data['tanggal_lahir_anak_kedua'] ?? NULL,
            'jenis_kelamin_anak_kedua' => $data['jenis_kelamin_anak_kedua'] ?? NULL,
            'pekerjaan_anak_kedua' => $data['pekerjaan_anak_kedua'] ?? NULL,
            'alamat_anak_kedua' => $data['alamat_anak_kedua'] ?? NULL,
            'motto_anak_kedua' => $data['motto_anak_kedua'] ?? NULL,
            'nama_anak_ketiga' => \strtoupper($data['nama_anak_ketiga'] ?? NULL),
            'tempat_lahir_anak_ketiga' => $data['tempat_lahir_anak_ketiga'] ?? NULL,
            'tanggal_lahir_anak_ketiga' => $data['tanggal_lahir_anak_ketiga'] ?? NULL,
            'jenis_kelamin_anak_ketiga' => $data['jenis_kelamin_anak_ketiga'] ?? NULL,
            'pekerjaan_anak_ketiga' => $data['pekerjaan_anak_ketiga'] ?? NULL,
            'alamat_anak_ketiga' => $data['alamat_anak_ketiga'] ?? NULL,
            'motto_anak_ketiga' => $data['motto_anak_ketiga'] ?? NULL,
            'nama_anak_keempat' => \strtoupper($data['nama_anak_keempat'] ?? NULL),
            'tempat_lahir_anak_keempat' => $data['tempat_lahir_anak_keempat'] ?? NULL,
            'tanggal_lahir_anak_keempat' => $data['tanggal_lahir_anak_keempat'] ?? NULL,
            'jenis_kelamin_anak_keempat' => $data['jenis_kelamin_anak_keempat'] ?? NULL,
            'pekerjaan_anak_keempat' => $data['pekerjaan_anak_keempat'] ?? NULL,
            'alamat_anak_keempat' => $data['alamat_anak_keempat'] ?? NULL,
            'motto_anak_keempat' => $data['motto_anak_keempat'] ?? NULL,
            'nama_anak_kelima' => \strtoupper($data['nama_anak_kelima'] ?? NULL),
            'tempat_lahir_anak_kelima' => $data['tempat_lahir_anak_kelima'] ?? NULL,
            'tanggal_lahir_anak_kelima' => $data['tanggal_lahir_anak_kelima'] ?? NULL,
            'jenis_kelamin_anak_kelima' => $data['jenis_kelamin_anak_kelima'] ?? NULL,
            'pekerjaan_anak_kelima' => $data['pekerjaan_anak_kelima'] ?? NULL,
            'alamat_anak_kelima' => $data['alamat_anak_kelima'] ?? NULL,
            'motto_anak_kelima' => $data['motto_anak_kelima'] ?? NULL,
        ]);

        $this->survey_id = $survey->id;
    }

    public function render()
    {
        return view('livewire.survey.isi-survey');
    }

    public function downloadPDF()
    {
        // return redirect()->route('download.pdf', ['id' => $this->survey_id]);
        $url = route('download.pdf', ['id' => $this->survey_id]);
        $this->dispatch('openTab', $url);
    }

    protected function generatePDF()
    {
        $this->dispatch('generating');
        // Ambil data survey beserta relasinya dari database
        $survey = Survey::with(['tarunaPhotos', 'baktiPhotos', 'berkaryaPhotos'])->find($this->survey_id);
        $data = [
            'title' => 'Alumni',
            'survey' => $survey
        ];

        // Nama direktori storage/surveys/NAMA-SAYA/ ..
        $namaDirektori = \strtoupper(Str::slug(Survey::find($this->survey_id)->nama));

        // Nama file saat proses: storage/surveys/NAMA-SAYA/jendral-polisi-nama-saya.pdf
        $simpleName = Str::slug("$survey->pangkat $survey->nama");

        // Nama file terakhir: storage/surveys/NAMA-SAYA/JENDRAL POLISI - NAMA SAYA.pdf
        $pdfName = \strtoupper("$survey->pangkat - $survey->nama.pdf");
        // $pdfName = \strtoupper(Str::slug($survey->pangkat, '_') . '-' . Str::slug($survey->nama, '_')) . '.pdf';

        // Menggabungkan PDF dengan COVER.pdf
        $coverPath = public_path('assets/pdf/COVER.pdf');

        // Cek direktori temp ada
        $directoryPath = storage_path('app/public/temp');
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $pdfMerge = new PdfMerge();
        $pdfMerge->add($coverPath);

        // Eksekusi PDF
        $pdf_profil = pdf_profil($data);
        $pdfMerge->add($pdf_profil);

        // $pdf_utama = pdf_utama($data);    
        // $pdfMerge->add($pdf_utama);

        // PDF Narasi Online
        $pdf_narasi_online = pdf_narasi_online($data);
        $pdfMerge->add($pdf_narasi_online);

        // PDF Keluarga
        $pdf_keluarga = pdf_keluarga($data);
        $pdfMerge->add($pdf_keluarga);

        // PDF Daftar Anak
        $pdf_daftar_anak = pdf_daftar_anak($data);
        $pdfMerge->add($pdf_daftar_anak);

        // PDF Bakti Akpol
        $pdf_bakti_akpol = pdf_bakti_akpol($data);
        $pdfMerge->add($pdf_bakti_akpol);

        // PDF Bakti Berkarya
        $pdf_berkarya = pdf_berkarya($data);
        $pdfMerge->add($pdf_berkarya);

        $mergedPdfOutput = storage_path('app/public/temp/merged_' . $simpleName . '.pdf');
        $pdfMerge->merge($mergedPdfOutput);

        $compressedPdfOutputSimple = storage_path('app/public/temp/compressed_' . $simpleName . '.pdf');
        $command = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook -dNOPAUSE -dQUIET -dBATCH -sOutputFile={$compressedPdfOutputSimple} {$mergedPdfOutput}";
        shell_exec($command);

        // Cek dan buat direktori tujuan jika belum ada
        $targetDirectory = storage_path('app/public/surveys/' . $namaDirektori);
        if (!File::exists($targetDirectory)) {
            File::makeDirectory($targetDirectory, 0755, true);
        }

        // Ganti nama file setelah dikompresi
        $compressedPdfOutput = $targetDirectory . '/' . $pdfName;
        rename($compressedPdfOutputSimple, $compressedPdfOutput);

        // Buat path relatif untuk disimpan ke database
        $relativePath = 'storage/surveys/' . $namaDirektori . '/' . $pdfName;

        $survey->update([
            'file_path' => $relativePath
        ]);

        $this->dispatch('generated');
        // Return path relatif
        return false;
    }
}

/* public function downloadPDF()
{
    // Ambil data survey beserta relasinya dari database
    // $survey = Survey::with(['tarunaPhotos', 'baktiPhotos', 'berkaryaPhotos'])->find($this->survey_id);
    $data = [
        'title' => 'Judul',
        'text' => 'lorem100'
    ];
    // Membuat PDF dari view
    $pdf = PDF::loadView('pdf.survey.hasil', $data)->setPaper('a4', 'portrait');;
    // $pdf->output();
    // return $pdf->download('hasil-survey.pdf');

    // Kirim PDF sebagai respons
    return response()->stream(function () use ($pdf) {
        $pdf->stream('hasil-survey.pdf');
    }, 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'attachment; filename="hasil-survey.pdf"',
    ]);
} */