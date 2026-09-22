<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DocumentCategoryController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PersonnelController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RelatedLinkController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', [LandingPageController::class, 'index'])->name('landing');

// Profil Pages
Route::get('/profil/struktur-organisasi', [LandingPageController::class, 'strukturOrganisasi'])->name('profil.struktur-organisasi');
Route::get('/profil/tugas-fungsi', [LandingPageController::class, 'tugasFungsi'])->name('profil.tugas-fungsi');

// Dokumen & SOP
Route::get('/dokumen', [DocumentController::class, 'index'])->name('dokumen.index');
Route::get('/dokumen/{document}/unduh', [DocumentController::class, 'download'])->name('dokumen.download');

// Galeri
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');

// Kontak
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('banners', BannerController::class)->except(['show']);
        Route::patch('banners/{banner}/toggle', [BannerController::class, 'toggle'])->name('banners.toggle');
        Route::get('profil', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profil', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('profil/struktur-organisasi', [ProfileController::class, 'struktur'])->name('profile.struktur');
        Route::put('profil/struktur-organisasi', [ProfileController::class, 'updateStruktur'])->name('profile.struktur.update');
        Route::get('profil/tugas-fungsi', [ProfileController::class, 'tugasFungsi'])->name('profile.tugas-fungsi');
        Route::put('profil/tugas-fungsi', [ProfileController::class, 'updateTugasFungsi'])->name('profile.tugas-fungsi.update');
        Route::resource('services', ServiceController::class)->except(['show']);
        Route::patch('services/{service}/toggle', [ServiceController::class, 'toggle'])->name('services.toggle');
        Route::resource('related-links', RelatedLinkController::class)->except(['show']);
        Route::patch('related-links/{related_link}/toggle', [RelatedLinkController::class, 'toggle'])->name('related-links.toggle');
        Route::resource('document-categories', DocumentCategoryController::class)->except(['show']);
        Route::resource('documents', AdminDocumentController::class)->except(['show']);
        Route::resource('galleries', AdminGalleryController::class)->except(['show']);
        Route::resource('personnels', PersonnelController::class)->except(['show']);

        Route::middleware('superadmin')->group(function () {
            Route::resource('users', UserController::class)->except(['show']);
            Route::get('site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
            Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
        });
    });
});
