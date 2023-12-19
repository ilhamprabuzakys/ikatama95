<?php

use Carbon\Carbon;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Http;
use Spatie\Browsershot\Browsershot;
use Stevebauman\Location\Facades\Location;

function getErrorsString($e)
{
    // Jika $e adalah instansi dari ValidationException, kita akan mengambil validator errors dari dalamnya
    if ($e instanceof Illuminate\Validation\ValidationException) {
        $errors = $e->validator->errors()->toArray();
    }
    // Jika $e adalah instansi dari MessageBag (hasil dari getErrorBag()), kita akan mengubahnya menjadi array
    elseif ($e instanceof Illuminate\Support\MessageBag) {
        $errors = $e->toArray();
    }
    // Jika $e adalah array, kita langsung menggunakannya sebagai $errors
    elseif (is_array($e)) {
        $errors = $e;
    }
    // Jika tidak memenuhi kedua kondisi di atas, kita bisa mengatur default atau mengembalikan pesan error
    else {
        return 'Terjadi kesalahan yang tidak dikenal.';
    }

    $errorString = '<br><br>';
    foreach ($errors as $field => $errorList) {
        foreach ($errorList as $error) {
            $errorString .= "<span class='text-danger text-start'>" . $error . "</span><br>";
        }
    }
    return $errorString;
}

function generateOTP()
{
    $otpLength = 6;
    $otp = '';

    for ($i = 0; $i < $otpLength; $i++) {
        $otp .= random_int(0, 9);
    }

    return $otp;
}

function getPublicIP()
{
    // Logic untuk mendapatkan IP public.
    $response = Http::get('http://ipecho.net/plain');
    // return $response->body();
    return request()->ip();
}


function generateUsername($email)
{
    return Str::before($email, '@');
}

function formatTanggalIndonesia($tanggal)
{
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $bulan = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Juni", "Juli", "Agust", "Sep", "Okto", "Nov", "Des");

    $namaHari = $hari[date('w', strtotime($tanggal))];
    $namaBulan = $bulan[date('n', strtotime($tanggal))];

    return $namaHari . ", " . date('d', strtotime($tanggal)) . " " . $namaBulan . " " . date('Y', strtotime($tanggal));
}

function getRole()
{
    return auth()->user()->role;
}
function getUserRoleDetail($role = '')
{
    if ($role == '') {
        $role = auth()->user()->role;
    }
    $detail = '';
    switch ($role) {
        case 'admin':
            $detail = 'Admin';
            break;
        case 'alumni':
            $detail = 'Alumni';
            break;
        default:
            break;
    }
    return $detail;
}

function getUserStatus($status = '')
{
    if ($status == '') {
        $status = auth()->user()->is_active;
    }
    $detail = '';
    switch ($status) {
        case true:
            $detail = 'Aktif';
            break;
        case false:
            $detail = 'Tidak Aktif';
            break;
        default:
            break;
    }
    return $detail;
}

function getUserStatusBG($status = '')
{
    if ($status == '') {
        $status = auth()->user()->is_active;
    }
    $bg = '';
    switch ($status) {
        case true:
            $bg = 'success';
            break;
        case false:
            $bg = 'danger';
            break;
        default:
            break;
    }
    return $bg;
}

function getUserRoleBG($role = '')
{
    if ($role == '') {
        $role = auth()->user()->role;
    }
    $bg = '';
    switch ($role) {
        case 'alumni':
            $bg = 'success';
            break;
        case 'admin':
            $bg = 'primary';
            break;
        default:
            break;
    }
    return $bg;
}

function getUserRoleShort($role = '')
{
    if ($role == '') {
        $role = auth()->user()->role;
    }
    $detail = '';
    switch ($role) {
        case 'admin':
            $detail = 'Admin';
            break;
        case 'alumni':
            $detail = 'Alumni';
            break;
        default:
            break;
    }
    // if ($detail != 'Admin') {
    //     $detail = strtoupper($detail);
    // }
    return $detail;
}

function getPages()
{
    $pages = collect([
        [
            'name' => 'Dashboard Utama',
            'icon' => 'mdi-monitor',
            'url' => route('dashboard')
        ],
        [
            'name' => 'Daftar Postingan',
            'icon' => 'mdi-library-outline',
            'url' => route('posts.index')
        ],
        [
            'name' => 'Buat Postingan',
            'icon' => 'mdi-library-outline',
            'url' => route('posts.create')
        ],
        [
            'name' => 'Daftar Ebook',
            'icon' => 'mdi-book-check-outline',
            'url' => route('ebooks.index')
        ],
        [
            'name' => 'Buat Ebook',
            'icon' => 'mdi-book-check-outline',
            'url' => route('ebooks.create')
        ],
        [
            'name' => 'Daftar Aktivitas',
            'icon' => 'mdi-resistor',
            'url' => route('logs.index')
        ],
        [
            'name' => 'Profil Saya',
            'icon' => 'mdi-account-outline',
            'url' => route('profile')
        ],
        [
            'name' => 'Pengaturan Profil',
            'icon' => 'mdi-account-outline',
            'url' => route('settings', ['tab' => 'profile'])
        ],
        [
            'name' => 'Pengaturan Keamanan',
            'icon' => 'mdi-cog-outline',
            'url' => route('settings', ['tab' => 'security'])
        ],
        [
            'name' => 'Pengaturan Sosial Media',
            'icon' => 'mdi-cog-outline',
            'url' => route('settings', ['tab' => 'social-media'])
        ],
    ]);
    return $pages;
}

function getRoleList()
{
    return collect([
        (object) ['key' => 'admin', 'label' => 'Admin'],
        (object) ['key' => 'alumni', 'label' => 'Alumni'],
    ]);
}

function getPengisianKusioner($user_id = '')
{
    $user_id = $user_id == '' ?  auth()->id() : $user_id;
    $user = User::findOrFail($user_id);
    $surveyCount = $user->surveys()->count();

    return $surveyCount;
}


// PDF FUNGSI
function pdf_berkarya($data)
{
    // Memastikan direktori temp ada
    if (!File::exists(storage_path('temp'))) {
        File::makeDirectory(storage_path('temp'), 0755, true);
    }

    $survey = $data['survey'];
    $paths = $survey->berkaryaPhotos->pluck('path')->toArray();
    $send = [
        'paths' => $paths,
        'survey' => $survey
    ];
    $html = view('pdf.survey.berkarya', $send)->render();

    // Simpan PDF ke sementara
    $tempPath = storage_path('temp/' . 'pdf_berkarya' . '.pdf');
    // file_put_contents($tempPath, $pdf->output());
    BrowserShot::html($html)->showBackground()->margins(0, 0, 0, 0)->format('A4')
        ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
        ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
        ->savePdf($tempPath);
    return $tempPath;
}

function pdf_bakti_akpol($data)
{
    // Memastikan direktori temp ada
    if (!File::exists(storage_path('temp'))) {
        File::makeDirectory(storage_path('temp'), 0755, true);
    }
    $survey = $data['survey'];
    $paths = $survey->baktiPhotos->pluck('path')->toArray();
    $send = [
        'paths' => $paths,
        'survey' => $survey
    ];
    $html = view('pdf.survey.bakti-akpol', $send)->render();

    // Simpan PDF ke sementara
    $tempPath = storage_path('temp/' . 'pdf_bakti_akpol' . '.pdf');
    // file_put_contents($tempPath, $pdf->output());
    BrowserShot::html($html)->showBackground()->margins(0, 0, 0, 0)->format('A4')
        ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
        ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
        ->savePdf($tempPath);
    return $tempPath;
}

function pdf_daftar_anak($data)
{
    // Memastikan direktori temp ada
    if (!File::exists(storage_path('temp'))) {
        File::makeDirectory(storage_path('temp'), 0755, true);
    }

    $html = view('pdf.survey.daftar-anak', $data)->render();

    // Simpan PDF ke sementara
    $tempPath = storage_path('temp/' . 'pdf_daftar_anak' . '.pdf');
    // file_put_contents($tempPath, $pdf->output());
    BrowserShot::html($html)->showBackground()->margins(0, 0, 0, 0)->format('A4')
        ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
        ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
        ->savePdf($tempPath);
    return $tempPath;
}

function pdf_keluarga($data)
{
    // Membuat PDF dari view
    // $pdf = Pdf::loadView('pdf.survey.keluarga-own', $data);

    // Memastikan direktori temp ada
    if (!File::exists(storage_path('temp'))) {
        File::makeDirectory(storage_path('temp'), 0755, true);
    }

    $html = view('pdf.survey.keluarga-custom', $data)->render();

    // Simpan PDF ke sementara
    $tempPath = storage_path('temp/' . 'pdf_keluarga' . '.pdf');
    // file_put_contents($tempPath, $pdf->output());
    BrowserShot::html($html)->showBackground()->margins(0, 0, 0, 0)->format('A4')
        ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
        ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
        ->savePdf($tempPath);
    return $tempPath;
}

function pdf_narasi_online($data)
{
    // Memastikan direktori temp ada
    if (!File::exists(storage_path('temp'))) {
        File::makeDirectory(storage_path('temp'), 0755, true);
    }

    $html = view('pdf.survey.narasi_online', $data)->render();

    // Simpan PDF ke sementara
    $tempPath = storage_path('temp/' . 'pdf_narasi_online' . '.pdf');
    // file_put_contents($tempPath, $pdf->output());
    BrowserShot::html($html)->showBackground()->margins(0, 0, 0, 0)->format('A4')
        ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
        ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
        ->savePdf($tempPath);
    return $tempPath;
}


function pdf_utama($data)
{
    // Membuat PDF dari view
    $pdf = Pdf::loadView('pdf.survey.profil', $data);

    // Memastikan direktori temp ada
    if (!File::exists(storage_path('temp'))) {
        File::makeDirectory(storage_path('temp'), 0755, true);
    }

    // Simpan PDF ke sementara
    $tempPath = storage_path('temp/' . 'pdf_utama' . '.pdf');
    file_put_contents($tempPath, $pdf->output());
    return $tempPath;
}

function pdf_profil($data)
{
    // Memastikan direktori temp ada
    if (!File::exists(storage_path('temp'))) {
        File::makeDirectory(storage_path('temp'), 0755, true);
    }

    $html = view('pdf.survey.profil', $data)->render();

    // Simpan PDF ke sementara
    $tempPath = storage_path('temp/' . 'pdf_profil' . '.pdf');
    // file_put_contents($tempPath, $pdf->output());
    Browsershot::html($html)->showBackground()->margins(0, 0, 0, 0)->format('A4')
        ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
        ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
        ->savePdf($tempPath);
    return $tempPath;
}

function pdf_dashboard_profile($data = [])
{
    // Lokasi direktori temp
    $directory = storage_path('app/public/tmp');

    // Memastikan direktori temp ada
    if (!File::exists($directory)) {
        File::makeDirectory($directory, 0755, true);
    }

    $html = view('livewire.dashboard.pengaturan.pengaturan-profile', $data)->render();

    // Simpan PDF ke sementara
    $tempPath = $directory . '/pdf_dashboard_profile.pdf';
    Browsershot::html($html)->showBackground()->margins(0, 0, 0, 0)->format('A4')
        ->setNodeBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/node')
        ->setNpmBinary('/home/ilahazs/.nvm/versions/node/v20.9.0/bin/npm')
        ->savePdf($tempPath);

    // Kompresi PDF
    $simpleName = 'pdf_dashboard_profile';
    $compressedPdfOutputSimple = storage_path('app/public/tmp/compressed_' . $simpleName . '.pdf');
    $command = "gs -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/ebook -dNOPAUSE -dQUIET -dBATCH -sOutputFile={$compressedPdfOutputSimple} {$tempPath}";
    shell_exec($command);

    // Menentukan nama file untuk unduhan
    $downloadFileName = auth()->user()->name . ' - IKATAMA 95.pdf';

    // Mengunduh file dengan nama yang telah ditentukan dan menghapusnya setelah diunduh
    return response()->download($compressedPdfOutputSimple, $downloadFileName)->deleteFileAfterSend(true);
}
