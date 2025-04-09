<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\ProfilDesaController;
use App\Http\Controllers\Public\DesaDalamAngkaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profil-desa', [ProfilDesaController::class, 'Index'])->name("profil-desa");
Route::get('/profil-desa', [ProfilDesaController::class, 'showProfilDesa'])->name('profil-desa');
Route::get('/desa-dalam-angka', [DesaDalamAngkaController::class, 'index'])->name('desa-dalam-angka');
// Route::get('/pera-desa', [ProfilDesaController::class, 'showProfilDesa'])->name('profil-desa');


// Route::get('/getDesaByKecamatan', function (Request $request) {
//     $desa = Desa::where('kdkec', $request->kdkec)->get();
//     return response()->json($desa);
// })->name('getDesaByKecamatan');

Route::middleware(['auth'])->group(function () {
    Route::resource('transparansi', TransparansiController::class);
});

Route::get('/storage/transparansi-docs/{filename}', function ($filename) {
    $path = "transparansi-docs/$filename";
    
    if (!Storage::disk('public')->exists($path)) {
        abort(404, 'File tidak ditemukan');
    }
    
    return response()->file(storage_path("app/public/$path"));
})->where('filename', '.*')->name('transparansi.download');









