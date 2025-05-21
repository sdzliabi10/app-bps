<?php


namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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