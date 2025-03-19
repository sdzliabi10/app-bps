<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\public\ProfilDesaController;
use App\Models\Desa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profil-desa', [ProfilDesaController::class, 'Index'])->name("profil-desa");
Route::get('/profil-desa', [ProfilDesaController::class, 'showProfilDesa'])->name('profil-desa');


// Route::get('/getDesaByKecamatan', function (Request $request) {
//     $desa = Desa::where('kdkec', $request->kdkec)->get();
//     return response()->json($desa);
// })->name('getDesaByKecamatan');
