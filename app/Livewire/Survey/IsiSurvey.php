<?php

namespace App\Livewire\Survey;

use App\Models\BaktiPhoto;
use App\Models\BerkaryaPhoto;
use App\Models\KolaseAlbumPhoto;
use App\Models\Survey;
use App\Models\TarunaPhoto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Title('Pengisian Survey IKATAMA 95')]
#[Layout('survey.layouts.app')]
class IsiSurvey extends Component
{
    public $survey_id = 1;
    public $sudah_mengisi = false;

    #[On('storeSurvey')]
    public function storeSurvey($results)
    {
        // Dekode hasil JSON
        $data = json_decode($results, true);

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

        $this->dispatch('surveyCompleted');
        $this->sudah_mengisi = true;
    }

    public function saveFotoAnakSemua($data)
    {
        // Foto Anak Pertama (jika ada)
        if (array_key_exists('foto_anak_pertama', $data)) {
            $this->saveImageToDirectory($data['foto_anak_pertama'][0], 'foto-anak-pertama');
        }

        // Foto Anak Kedua (jika ada)
        if (array_key_exists('foto_anak_kedua', $data)) {
            $this->saveImageToDirectory($data['foto_anak_kedua'][0], 'foto-anak-kedua');
        }

        // Foto Anak Ketiga (jika ada)
        if (array_key_exists('foto_anak_ketiga', $data)) {
            $this->saveImageToDirectory($data['foto_anak_ketiga'][0], 'foto-anak-ketiga');
        }

        // Foto Anak Keempat (jika ada)
        if (array_key_exists('foto_anak_keempat', $data)) {
            $this->saveImageToDirectory($data['foto_anak_keempat'][0], 'foto-anak-keempat');
        }

        // Foto Anak Kelima (jika ada)
        if (array_key_exists('foto_anak_kelima', $data)) {
            $this->saveImageToDirectory($data['foto_anak_kelima'][0], 'foto-anak-kelima');
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

        $base64Image = $imageData['content']; // Ambil bagian content sebagai base64

        if (Str::startsWith($base64Image, 'data:image')) {
            [$type, $base64Image] = explode(';', $base64Image);
            [, $base64Image]      = explode(',', $base64Image);
            $image = base64_decode($base64Image);

            $filename = $namaPengisi . '_' . $waktuSekarang . '_' . \random_int(333, 10000) . '.jpg';
            Storage::disk('public')->put('surveys/' . $namaPengisi . '/' . $directory . '/' . $filename,     $image);
            // Tambahkan prefix storage/ ke filename yang akan dikembalikan
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

        $survey = Survey::create([
            'user_id' => Auth::check() ? auth()->id() : null,
            'nama' => \strtoupper($data['nama']),
            'panggilan' => $data['panggilan'],
            'tempat_lahir' => $data['tempat_lahir'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'pangkat' => $pangkat,
            'nrp' => $data['nrp'],
            'status_kedinasan' => $status_kedinasan,
            'status_pernikahan' => $status_pernikahan,
            'jumlah_anak' => $data['jumlah_anak'],
            'no_telepon' => $data['no_telepon'],
            'email' => $data['email'],
            'alamat' => $data['alamat'],
            'motto' => $data['motto'],
            'narasi_personal' => $data['narasi_personal'],
            'narasi_keluarga' => $data['narasi_keluarga'],
            'nama_anak_pertama' => array_key_exists('nama_anak_pertama', $data) ? \strtoupper($data['nama_anak_pertama']) : null,
            'tempat_lahir_anak_pertama' => array_key_exists('tempat_lahir_anak_pertama', $data) ? $data['tempat_lahir_anak_pertama'] : null,
            'jenis_kelamin_anak_pertama' => array_key_exists('jenis_kelamin_anak_pertama', $data) ? $data['jenis_kelamin_anak_pertama'] : null,
            'pekerjaan_anak_pertama' => array_key_exists('pekerjaan_anak_pertama', $data) ? $data['pekerjaan_anak_pertama'] : null,
            'alamat_anak_pertama' => array_key_exists('alamat_anak_pertama', $data) ? $data['alamat_anak_pertama'] : null,
            'motto_anak_pertama' => array_key_exists('motto_anak_pertama', $data) ? $data['motto_anak_pertama'] : null,

            'nama_anak_kedua' => array_key_exists('nama_anak_kedua', $data) ? \strtoupper($data['nama_anak_kedua']) : null,
            'tempat_lahir_anak_kedua' => array_key_exists('tempat_lahir_anak_kedua', $data) ? $data['tempat_lahir_anak_kedua'] : null,
            'jenis_kelamin_anak_kedua' => array_key_exists('jenis_kelamin_anak_kedua', $data) ? $data['jenis_kelamin_anak_kedua'] : null,
            'pekerjaan_anak_kedua' => array_key_exists('pekerjaan_anak_kedua', $data) ? $data['pekerjaan_anak_kedua'] : null,
            'alamat_anak_kedua' => array_key_exists('alamat_anak_kedua', $data) ? $data['alamat_anak_kedua'] : null,
            'motto_anak_kedua' => array_key_exists('motto_anak_kedua', $data) ? $data['motto_anak_kedua'] : null,

            'nama_anak_ketiga' => array_key_exists('nama_anak_ketiga', $data) ? \strtoupper($data['nama_anak_ketiga']) : null,
            'tempat_lahir_anak_ketiga' => array_key_exists('tempat_lahir_anak_ketiga', $data) ? $data['tempat_lahir_anak_ketiga'] : null,
            'jenis_kelamin_anak_ketiga' => array_key_exists('jenis_kelamin_anak_ketiga', $data) ? $data['jenis_kelamin_anak_ketiga'] : null,
            'pekerjaan_anak_ketiga' => array_key_exists('pekerjaan_anak_ketiga', $data) ? $data['pekerjaan_anak_ketiga'] : null,
            'alamat_anak_ketiga' => array_key_exists('alamat_anak_ketiga', $data) ? $data['alamat_anak_ketiga'] : null,
            'motto_anak_ketiga' => array_key_exists('motto_anak_ketiga', $data) ? $data['motto_anak_ketiga'] : null,

            'nama_anak_keempat' => array_key_exists('nama_anak_keempat', $data) ? \strtoupper($data['nama_anak_keempat']) : null,
            'tempat_lahir_anak_keempat' => array_key_exists('tempat_lahir_anak_keempat', $data) ? $data['tempat_lahir_anak_keempat'] : null,
            'jenis_kelamin_anak_keempat' => array_key_exists('jenis_kelamin_anak_keempat', $data) ? $data['jenis_kelamin_anak_keempat'] : null,
            'pekerjaan_anak_keempat' => array_key_exists('pekerjaan_anak_keempat', $data) ? $data['pekerjaan_anak_keempat'] : null,
            'alamat_anak_keempat' => array_key_exists('alamat_anak_keempat', $data) ? $data['alamat_anak_keempat'] : null,
            'motto_anak_keempat' => array_key_exists('motto_anak_keempat', $data) ? $data['motto_anak_keempat'] : null,

            'nama_anak_kelima' => array_key_exists('nama_anak_kelima', $data) ? \strtoupper($data['nama_anak_kelima']) : null,
            'tempat_lahir_anak_kelima' => array_key_exists('tempat_lahir_anak_kelima', $data) ? $data['tempat_lahir_anak_kelima'] : null,
            'jenis_kelamin_anak_kelima' => array_key_exists('jenis_kelamin_anak_kelima', $data) ? $data['jenis_kelamin_anak_kelima'] : null,
            'pekerjaan_anak_kelima' => array_key_exists('pekerjaan_anak_kelima', $data) ? $data['pekerjaan_anak_kelima'] : null,
            'alamat_anak_kelima' => array_key_exists('alamat_anak_kelima', $data) ? $data['alamat_anak_kelima'] : null,
            'motto_anak_kelima' => array_key_exists('motto_anak_kelima', $data) ? $data['motto_anak_kelima'] : null,
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