<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;
use App\Models\DataKategori;


class DesaDalamAngkaController extends Controller
{
    public function index(Request $request)
    {

        // Get kecamatan list from database
        $kecamatanList = DB::table('kecamatan')->orderBy('nmkec')->get();
        // Initialize desa list
        $desaList = collect();

        // Get all desa initially (will be filtered by JavaScript)
        $desaList = DB::table('desa')->orderBy('nmdesa')->get();

                // Ambil daftar kategori dan data kategori
                $kategoriList = Kategori::orderBy('nama_Kategori')->get();
                $dataKategoriList = DataKategori::orderBy('nama_data')->get();
        return view('public.desa-dalam-angka', compact( 'kecamatanList', 'desaList', 'kategoriList', 'dataKategoriList'));
    }
}
