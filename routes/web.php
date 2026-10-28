<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Autentikasi (login & logout). Registrasi dimatikan karena akun admin dibuat lewat seeder.
Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::middleware('auth')->group(function () {
    // Halaman Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/home', [DashboardController::class, 'index'])->name('home');

    // Master Data Kelas
    Route::resource('kelas', KelasController::class)->except('show');

    // Master Data Siswa
    Route::resource('siswa', SiswaController::class);

    // Master Data Guru
    Route::resource('guru', GuruController::class)->except('show');

    // Master Data Mata Pelajaran (Mapel)
    Route::resource('mapel', MapelController::class)->except('show');

    // Data Nilai Akademik
    Route::resource('nilai', NilaiController::class)->except('show');
});
