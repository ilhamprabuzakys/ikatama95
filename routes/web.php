<?php

// use App\Livewire\Home\HomeIndex;

use App\Http\Controllers\ExportController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PDFViewController;
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

URL::forceRootUrl(config('app.url'));

$redirect_login = [
    'login', 'wp-admin', 'wp-login', 'signin', 'masuk'
 ];
 
 Route::get('/{path}', function ($path) use ($redirect_login) {
    if (in_array($path, $redirect_login)) {
       return redirect()->route('login');
    } else {
       abort(404); 
    }
 })->where('path', implode('|', $redirect_login));

// Halaman terpisah untuk mengisi survey
Route::get('/survey', IsiSurvey::class)->name('survey.isi');

Route::middleware(['guest'])->group(function () {
    // Route::get('/', HomeIndex::class)->name('home.index');
    Route::get('/', Login::class)->name('login');
    Route::get('/lupa-password', LupaPassword::class)->name('lupa-password');
});


Route::controller(PDFController::class)->group(function ()  {
    Route::get('/cetak-dashboard-profile', 'print_dashboard_profile')->name('pdf.dashboard_profile');
    Route::get('/download-pdf/{id}', 'download')->name('download.pdf');
    Route::get('/preview-pdf/{id}', 'preview_formulir')->name('preview.formulir');
});

Route::controller(PDFViewController::class)->group(function () {
    Route::get('/keluarga', 'keluarga')->name('pdf.keluarga');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    // Menu Formulir   
    Route::group(['prefix' => 'formulir', 'as' => 'formulir.'], function () {
        Route::get('/export-formulir', [ExportController::class, 'exportFormulir'])->name('export');
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
});
