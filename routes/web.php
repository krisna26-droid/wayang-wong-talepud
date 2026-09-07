<?php

use App\Http\Controllers\Admin\ArsipBudayaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KarakterController;
use App\Http\Controllers\Admin\PemeranController;
use App\Http\Controllers\Admin\TopengController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sejarah', [HomeController::class, 'sejarah'])->name('sejarah');

// Katalog Publik
Route::get('/arsip', [HomeController::class, 'arsip'])->name('arsip.index');
Route::get('/arsip/{id}', [HomeController::class, 'arsipDetail'])->name('arsip.show');
Route::get('/topeng', [HomeController::class, 'topeng'])->name('topeng.index');
Route::get('/topeng/{id}', [HomeController::class, 'topengDetail'])->name('topeng.show');
Route::get('/karakter', [HomeController::class, 'karakter'])->name('karakter.index');
Route::get('/karakter/{id}/video', [HomeController::class, 'karakterVideo'])->name('karakter.video');
Route::get('/pemeran', [HomeController::class, 'pemeran'])->name('pemeran.index');
/*
|--------------------------------------------------------------------------
| Autentikasi Admin
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Panel Admin (Terproteksi Middleware Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('topeng', TopengController::class);
    Route::resource('arsip', ArsipBudayaController::class);
    Route::resource('karakter', KarakterController::class);
    Route::resource('pemeran', PemeranController::class);
});