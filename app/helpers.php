<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Jenssegers\Agent\Agent;
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

function formatTanggalIndonesia($tanggal)
{
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $bulan = array("", "Jan", "Feb", "Mar", "Apr", "Mei", "Juni", "Juli", "Agust", "Sep", "Okto", "Nov", "Des");

    $namaHari = $hari[date('w', strtotime($tanggal))];
    $namaBulan = $bulan[date('n', strtotime($tanggal))];

    return $namaHari . ", " . date('d', strtotime($tanggal)) . " " . $namaBulan . " " . date('Y', strtotime($tanggal));
}

function getUserRoleDetail($role = '')
{
    if ($role == '') {
        $role = auth()->user()->role;
    }
    $detail = '';
    switch ($role) {
        case 'dayamas':
            $detail = 'Deputi Bidang Pemberdayaan Masyarakat';
            break;
        case 'dayatif':
            $detail = 'Direktorat Pemberdayaan Alternatif';
            break;
        case 'psm':
            $detail = 'Direktorat Peran Serta Masyarakat';
            break;
        case 'admin':
            $detail = 'Admin';
            break;
        default:
            break;
    }
    return $detail;
}

function getUserRoleBG($role = '')
{
    if ($role == '') {
        $role = auth()->user()->role;
    }
    $bg = '';
    switch ($role) {
        case 'dayamas':
            $bg = 'danger';
            break;
        case 'dayatif':
            $bg = 'success';
            break;
        case 'psm':
            $bg = 'warning';
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
        case 'dayamas':
            $detail = 'Dayamas';
            break;
        case 'dayatif':
            $detail = 'Dayatif';
            break;
        case 'psm':
            $detail = 'PSM';
            break;
        case 'admin':
            $detail = 'Admin';
            break;
        default:
            break;
    }
    if ($detail != 'Admin') {
        $detail = strtoupper($detail);
    }
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
