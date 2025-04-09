<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\DataKategori;
use App\Models\Kecamatan;
use App\Models\Desa;


class DesaDalamAngkaController extends Controller
{
    public function index(Request $request)
    {

        // Ambil nilai filter dari request
    $tahun = $request->input('tahun');
    $kategori = $request->input('kategori');
    $data = $request->input('data');
    $kecamatan = $request->input('kecamatan');
    $desa = $request->input('desa');

    $kecamatanList = Kecamatan::orderBy('nmkec')->get(); // Eloquent
    $desaList = Desa::orderBy('nmdesa')->get();          // Eloquent
    $kategoriList = Kategori::orderBy('nama_Kategori')->get();
    $dataKategoriList = DataKategori::orderBy('nama_data')->get();

    // Ambil data terpilih (jika ada)
    $selectedKecamatan = $kecamatan ? Kecamatan::find($kecamatan) : null;
    $selectedDesa = $desa ? Desa::find($desa) : null;

    return view('public.desa-dalam-angka', compact(
        'kecamatanList', 
        'desaList', 
        'kategoriList', 
        'dataKategoriList',
        'tahun',
        'kategori',
        'data',
        'kecamatan',
        'desa',
        'selectedKecamatan',
        'selectedDesa',
    ));
    }
}

// namespace App\Http\Controllers;


// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
// use App\Models\Kategori;
// use App\Models\DataKategori;
// use App\Models\Desa;
// use App\Models\Kecamatan;

// class DesaDalamAngkaController extends Controller
// {
//     public function index(Request $request)
//     {
//         // Get filter values from request
//         $tahun = $request->input('tahun');
//         $kategori = $request->input('kategori');
//         $data = $request->input('data');
//         $kecamatan = $request->input('kecamatan');
//         $desa = $request->input('desa');

        // Get lists for dropdowns
        // $kecamatanList = Kecamatan::orderBy('nmkec')->get();
        // $desaList = Desa::orderBy('nmdesa')->get();
//         $kecamatanList = DB::table('kecamatan')->orderBy('nmkec')->get();
//         $desaList = DB::table('desa')->orderBy('nmdesa')->get();

//         $kategoriList = Kategori::orderBy('nama_Kategori')->get();
//         $dataKategoriList = DataKategori::orderBy('nama_data')->get();

//         $selectedKecamatan = $kecamatan ? DB::table('kecamatan')->where('kdkec', $kecamatan)->first() : null;
//     $selectedDesa = $desa ? DB::table('desa')->where('iddesa', $desa)->first() : null;



//         return view('public.desa-dalam-angka', compact(
//             'kecamatanList',
//             'desaList',
//             'kategoriList',
//             'dataKategoriList',
//             'tahun',
//             'kategori',
//             'data',
//             'kecamatan',
//             'desa',
//             'selectedKecamatan',
//             'selectedDesa'
//         ));
//     }
// }
