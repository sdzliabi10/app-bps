<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kecamatan;
use App\Models\Desa;
use App\Models\ProfilDesa;
use App\Models\PerangkatDesa;
use App\Models\Pendapatan;
use App\Models\Pembelanjaan;
use App\Models\Bpd;
use App\Models\Lpmdk;
use App\Models\PkkDesa;
use App\Models\Bumdes;

class ProfilDesaController extends Controller
{

    public function showProfilDesa(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();
        // $perangkat = PerangkatDesa::all();        
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
        $perangkat = collect(); // Buat koleksi kosong
        $keuangan = collect();
        $pendapatan = collect();
        $pembelanjaan = collect();
        $bpd = collect();
        $lpmdk = collect();
        $pkkDesa = collect();
        $bumdes = collect();
        $bumdesDetail = collect();


        if ($request->has('desa')) {
            $profilDesas = ProfilDesa::where('kddesa', $request->desa)->get();
            $perangkat = PerangkatDesa::where('iddesa', $request->desa)->get();
            $pendapatan = Pendapatan::where('iddesa', $request->desa)->get();
            $pembelanjaan = Pembelanjaan::where('iddesa', $request->desa)->get();
            $bpd = Bpd::where('iddesa', $request->desa)->get();
            $lpmdk = Lpmdk::where('iddesa', $request->desa)->get();
            $pkkDesa = PkkDesa::where('iddesa', $request->desa)->get();
            $bumdes = Bumdes::where('iddesa', $request->desa)->get();
            
            $lpmdk = [
                ['data' => 'Jumlah Pengurus', 'jumlah' => $lpmdk->sum('jumlah_pengurus')],
                ['data' => 'Jumlah Kegiatan', 'jumlah' => $lpmdk->sum('jumlah_kegiatan')],
                ['data' => 'Jumlah Dana', 'jumlah' => $lpmdk->sum('jumlah_dana')]
            ];
    
            $pkkDesa = [
                ['data' => 'Jumlah Pengurus', 'jumlah' => $pkkDesa->sum('jumlah_pengurus')],
                ['data' => 'Jumlah Anggota', 'jumlah' => $pkkDesa->sum('jumlah_anggota')],
                ['data' => 'Jumlah Buku Administrasi', 'jumlah' => $pkkDesa->sum('jumlah_buku_administrasi')],
                ['data' => 'Jumlah Dana', 'jumlah' => $pkkDesa->sum('jumlah_dana')]
            ];
    
            // First get the BUMDES summary
            $bumdesSummary = [
                ['data' => 'Jumlah BUMDES', 'jumlah' => $bumdes->count()]
            ];

            // Now get the BUMDES details before overwriting $bumdes
            $bumdesDetail = $bumdes->map(function($item) {
                return [
                    'nama' => $item->nama,
                    'deskripsi' => $item->deskripsi
                ];
            });

            // Finally assign the summary to $bumdes
            $bumdes = $bumdesSummary;

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
            'lpmdk',
            'pkkDesa',
            'bumdes',
            'bumdesDetail',
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