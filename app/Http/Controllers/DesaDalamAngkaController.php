<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\DataKategori;
use App\Models\Desa;
use App\Models\Kecamatan;

class DesaDalamAngkaController extends Controller
{
    public function index(Request $request)
    {
        $kecamatanList = Kecamatan::orderBy('nmkec')->get();
        $desaList = Desa::orderBy('nmdesa')->get();

        $kategoriList = Kategori::orderBy('nama_Kategori')->get();
        $dataKategoriList = DataKategori::orderBy('nama_data')->get();
        return view('public.desa-dalam-angka', compact('kecamatanList', 'desaList', 'kategoriList', 'dataKategoriList'));
    }
}
