<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\ProfilDesa;
use App\Models\PerangkatDesa;
use App\Models\PeraturanDesa;
use App\Models\EdaranKepalaDesa;
use App\Models\Program;

class ProfilDesaController extends Controller
{

    public function showProfilDesa(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        $perangkat = PerangkatDesa::all();
        $keuangan = [];
        $bpd = [];
        // Inisialisasi koleksi kosong untuk data transparansi
        $peraturanDesas = collect(); // Menggunakan koleksi Laravel
        $edaranKepalaDesas = collect(); // Menggunakan koleksi Laravel
        $programPusat = collect(); // Menggunakan koleksi Laravel
        $programProvinsi = collect(); // Menggunakan koleksi Laravel
        $programKabupaten = collect(); // Menggunakan koleksi Laravel

        // Ambil data program bantuan dari database
        $programs = [];



        // Hitung total keluarga penerima
        $totalPenerima = collect($programs)->sum('jumlah_keluarga');

                // Data infrastruktur dengan kategori tetap, tetapi nilai kosong
                // $infrastruktur = [
                //     ['kategori' => 'Jumlah Jembatan', 'nilai' => ''],
                //     ['kategori' => 'Tempat Pembuangan Sampah', 'nilai' => ''],
                //     ['kategori' => 'Jumlah Pasar', 'nilai' => ''],
                //     ['kategori' => 'Jumlah Jalan Desa', 'nilai' => ''],
                //     ['kategori' => 'Jumlah Jalan Kabupaten', 'nilai' => ''],
                //     ['kategori' => 'Jumlah Irigasi', 'nilai' => ''],
                //     ['kategori' => 'Jumlah Pusat Perdagangan', 'nilai' => ''],
                //     ['kategori' => 'Jumlah Rumah Potong Hewan', 'nilai' => ''],
                // ];

                $infrastruktur = [
                    [
                        'id' => 1,
                        'kategori' => 'Jumlah Jembatan',
                        'nilai' => null, // Awalnya kosong
                        'columns' => ['Nama Jembatan', 'Panjang (m)', 'Tahun Dibangun'],
                        'data' => [
                            [null, null, null], // Data awalnya kosong
                        ],
                    ],
                    [
                        'id' => 2,
                        'kategori' => 'Tempat Pembuangan Sampah',
                        'nilai' => null, // Awalnya kosong
                        'columns' => ['Lokasi', 'Kapasitas (Ton)', 'Tahun Dibangun'],
                        'data' => [
                            [null, null, null], // Data awalnya kosong
                        ],
                    ],
                    [
                        'id' => 3,
                        'kategori' => 'Jumlah Pasar',
                        'nilai' => null, // Contoh nilai
                        'columns' => ['Nama Pasar', 'Luas (m²)', 'Tahun Dibangun'],
                        'data' => [
                            [null, null, null],
                        ],
                    ],
                    [
                        'id' => 4,
                        'kategori' => 'Jumlah Jalan Desa',
                        'nilai' => null, // Contoh nilai
                        'columns' => ['Nama Jalan', 'Panjang (km)', 'Kondisi'],
                        'data' => [
                            [null, null, null],
                        ],
                    ],
                    [
                        'id' => 5,
                        'kategori' => 'Jumlah Jalan Kabupaten',
                        'nilai' => null, // Contoh nilai
                        'columns' => ['Nama Jalan', 'Panjang (km)', 'Kondisi'],
                        'data' => [
                            [null, null, null],
                        ],
                    ],
                    [
                        'id' => 6,
                        'kategori' => 'Jumlah Irigasi',
                        'nilai' => null, // Contoh nilai
                        'columns' => ['Nama Irigasi', 'Panjang (km)', 'Tahun Dibangun'],
                        'data' => [
                            [null, null, null],
                        ],
                    ],
                    [
                        'id' => 7,
                        'kategori' => 'Jumlah Pusat Perdagangan',
                        'nilai' => null, // Contoh nilai
                        'columns' => ['Nama Pusat Perdagangan', 'Luas (m²)', 'Tahun Dibangun'],
                        'data' => [
                            [null, null, null],
                        ],
                    ],
                    [
                        'id' => 8,
                        'kategori' => 'Jumlah Rumah Potong Hewan',
                        'nilai' => null, // Contoh nilai
                        'columns' => ['Nama RPH', 'Kapasitas (Ton/Hari)', 'Tahun Dibangun'],
                        'data' => [
                            [null, null, null],
                        ],
                    ],
                    // Tambahkan data lainnya...
                ];
                // $infrastruktur = []; 


        // Filter berdasarkan desa yang dipilih
        $profilDesas = collect(); // Buat koleksi kosong

        if ($request->has('desa')) {
            $profilDesas = ProfilDesa::where('kddesa', $request->desa)->get();

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
            'bpd',
            'peraturanDesas',
            'edaranKepalaDesas',
            'programPusat',
            'programProvinsi',
            'programKabupaten',
            'programs', // Tambahkan variabel programs
            'totalPenerima',
            'infrastruktur'
        ));
    }
}
