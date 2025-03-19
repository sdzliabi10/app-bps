<?php
use App\Http\Controllers\Backend\ProfilDesaController;
// use App\Http\Controllers\Backend\PerangkatDesaController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return 'Test Route';
});

Route::get('/', function () {
    return view('/admin/dashboard');
});

// Route::get('/profil-desa', [ProfilDesaController::class, 'Index'])->name('profil.desa');


Route::resource('profil-desa', ProfilDesaController::class);
Route::resource('perangkat-desa', ProfilDesaController::class);
// Route::resource('perangkat-desa', ProfilDesaController::class);

// Route::get('/admin-profil', function () {
//     return view('/admin/profil-desa/index');
// });