<?php

// use App\Livewire\Home\HomeIndex;

use App\Http\Controllers\PDFController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\LupaPassword;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Formulir\FormulirCreate;
use App\Livewire\Dashboard\Formulir\FormulirIndex;
use App\Livewire\Dashboard\Formulir\FormulirUpdate;
use App\Livewire\Dashboard\Pengaturan\PengaturanKeamanan;
use App\Livewire\Dashboard\Pengaturan\PengaturanProfile;
use App\Livewire\Dashboard\Pengaturan\PengaturanUser;
use App\Livewire\Dashboard\Pengaturan\PengaturanWebsite;
use App\Livewire\Survey\IsiSurvey;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

// URL::forceRootUrl(config('app.url'));

// Halaman terpisah untuk mengisi survey
Route::get('/survey', IsiSurvey::class)->name('survey.isi');

Route::middleware(['guest'])->group(function () {
    // Route::get('/', HomeIndex::class)->name('home.index');
    Route::get('/', Login::class)->name('login');
    Route::get('/lupa-password', LupaPassword::class)->name('lupa-password');
});
Route::get('/download-pdf/{id}', [PDFController::class, 'download'])->name('download.pdf');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Menu Formulir   
    Route::group(['prefix' => 'formulir', 'as' => 'formulir.'], function () {
        Route::get('/', FormulirIndex::class)->name('index');
        // Route::get('/tambah', FormulirCreate::class)->name('create');
        // Route::get('/{formulir}/edit', FormulirUpdate::class)->name('update');
    });

    // Menu Pengaturan
    Route::group(['prefix' => 'pengaturan', 'as' => 'pengaturan.'], function () {
        // Profil Settings
        Route::get('/profil-saya', PengaturanProfile::class)->name('profile');
        Route::get('/keamanan', PengaturanKeamanan::class)->name('keamanan');

        Route::middleware(['role:admin'])->group(function () {
            // Pengaturan User
            Route::get('/user', PengaturanUser::class)->name('user');
            // Pengaturan Website
            Route::get('/website', PengaturanWebsite::class)->name('website');
        });
    });

    Route::get('/pdf', function () {
        $data = [
            'title' => 'Judul',
            'text' => 'lorem ipsum dolor sit amet consectetur adipiscing elit...'
        ];

        $pdf = Pdf::loadView('pdf.survey.hasil', $data);
        return $pdf->download('document.pdf');
    });
});
