<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\DataKategori;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Support\Facades\DB;

class DesaDalamAngkaController extends Controller
{
    public function index(Request $request)
    {
        $kategoriList = Kategori::all();
        $dataKategoriList = DataKategori::all();
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();

        $tahun = $request->input('tahun');
        $kategori = $request->input('kategori');
        $data = $request->input('data');
        $kecamatan = $request->input('kecamatan');
        $desa = $request->input('desa');

        $filteredData = null;
        
        if ($data && $desa) {
            $dataKategori = DataKategori::find($data);
            if ($dataKategori) {
                $tabelReferensi = $dataKategori->tabel_referensi;
                
                $filteredData = DB::table($tabelReferensi)
                    ->where('iddesa', $desa)
                    ->when($tahun, function ($query) use ($tahun) {
                        return $query->whereYear('created_at', $tahun);
                    })
                    ->get();
            }
        }

        return view('public.desa-dalam-angka', compact(
            'kategoriList',
            'dataKategoriList',
            'kecamatanList',
            'desaList',
            'filteredData'
        ));
    }
}
