<?php

use App\Livewire\Home\HomeIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\LupaPassword;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Laporan\CariLaporan;
use App\Livewire\Dashboard\Laporan\LaporanRelawan;
use App\Livewire\Dashboard\Laporan\RekapLaporan;
use App\Livewire\Dashboard\Pengaturan\PengaturanKeamanan;
use App\Livewire\Dashboard\Pengaturan\PengaturanProfile;
use App\Livewire\Dashboard\Pengaturan\PengaturanUser;
use App\Livewire\Dashboard\Pengaturan\PengaturanWebsite;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

// URL::forceRootUrl(config('app.url'));

Route::middleware(['guest'])->group(function () {
    // Route::get('/', HomeIndex::class)->name('home.index');
    Route::get('/', Login::class)->name('login');
    Route::get('/lupa-password', LupaPassword::class)->name('lupa-password');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Menu Laporan
    Route::group(['prefix' => 'laporan', 'as' => 'laporan.'], function () {
        Route::get('/laporan-relawan', LaporanRelawan::class)->name('laporan-relawan');
        Route::get('/cari-laporan', CariLaporan::class)->name('cari-laporan');
        Route::get('/rekap-laporan', RekapLaporan::class)->name('rekap-laporan');
    });

    
    Route::group(['prefix' => 'pengaturan', 'as' => 'pengaturan.'], function () {
        // Pengaturan Website
        Route::get('/website', PengaturanWebsite::class)->name('website');
        // Profil Settings
        Route::get('/profil-saya', PengaturanProfile::class)->name('profile');
        Route::get('/keamanan', PengaturanKeamanan::class)->name('keamanan');
        // Pengaturan User
        Route::get('/user', PengaturanUser::class)->name('user');
    });
});
