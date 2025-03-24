<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\ProfilDesa;
use App\Models\PerangkatDesa;
use App\Models\Pendapatan;
use App\Models\Pembelanjaan;
use App\Models\PeraturanDesa;
use App\Models\EdaranKepalaDesa;
use App\Models\Program;

class ProfilDesaController extends Controller
{

    public function showProfilDesa(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        // $perangkat = PerangkatDesa::all();
        $bpd = [];
        // Inisialisasi koleksi kosong untuk data transparansi
        $peraturanDesas = collect(); // Menggunakan koleksi Laravel
        $edaranKepalaDesas = collect(); // Menggunakan koleksi Laravel
        $programPusat = collect(); // Menggunakan koleksi Laravel
        $programProvinsi = collect(); // Menggunakan koleksi Laravel
        $programKabupaten = collect(); // Menggunakan koleksi Laravel
        
        
        // Filter berdasarkan desa yang dipilih
        $profilDesas = collect(); // Buat koleksi kosong
        $perangkat = collect(); // Buat koleksi kosong
        $keuangan = collect();
        $pendapatan = collect();
        $pembelanjaan = collect();

        if ($request->has('desa')) {
            $profilDesas = ProfilDesa::where('kddesa', $request->desa)->get();
            $perangkat = PerangkatDesa::where('iddesa', $request->desa)->get();
            $pendapatan = Pendapatan::where('iddesa', $request->desa)->get();
            $pembelanjaan = Pembelanjaan::where('iddesa', $request->desa)->get();

            // Ambil data transparansi berdasarkan desa yang dipilih
            // $peraturanDesas = PeraturanDesa::where('kddesa', $request->desa)->get();
            // $edaranKepalaDesas = EdaranKepalaDesa::where('kddesa', $request->desa)->get();
            // $programPusat = Program::where('kddesa', $request->desa)->where('sumber', 'Pusat')->get();
            // $programProvinsi = Program::where('kddesa', $request->desa)->where('sumber', 'Provinsi')->get();
            // $programKabupaten = Program::where('kddesa', $request->desa)->where('sumber', 'Kabupaten')->get();
        }

        return view('public.profil-desa', compact(
            'kecamatanList',
            'desaList',
            'profilDesas',
            'keuangan',
            'perangkat',
            'pendapatan',
            'pembelanjaan',
            'bpd',
            'peraturanDesas',
            'edaranKepalaDesas',
            'programPusat',
            'programProvinsi',
            'programKabupaten'
        ));
    }
}
