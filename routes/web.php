<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\public\ProfilDesaController;
use Illuminate\Support\Facades\Route;

// Route untuk pengunjung
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profil-desa', [ProfilDesaController::class, 'Index'])->name("profil-desa");
