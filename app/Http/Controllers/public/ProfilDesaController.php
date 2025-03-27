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
use App\Models\Jembatan;
use App\Models\Pasar;
use App\Models\PembuanganSampah;
use App\Models\JalanDesa;
use App\Models\JalanKab;
use App\Models\PusatPerdagangan;
use App\Models\Irigasi;
use App\Models\RumahPotongHewan;

class ProfilDesaController extends Controller
{

    public function showProfilDesa(Request $request)
    {
        $kecamatanList = Kecamatan::all();
        $desaList = Desa::all();

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

        $infrastruktur = [];

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
        $jembatan = [];
        $pasar = [];
        $pembuanganSampah = [];
        $jalanDesa = [];
        $jalanKabupaten = [];
        $pusatPerdagangan = [];
        $irigasi = [];
        $rumahPotongHewan = [];

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
            $bumdesDetail = $bumdes->map(function ($item) {
                return [
                    'nama' => $item->nama,
                    'deskripsi' => $item->deskripsi
                ];
            });

            // Finally assign the summary to $bumdes
            $bumdes = $bumdesSummary;

            $jembatan = Jembatan::where('iddesa', $request->desa)
                ->select('id', 'nama_jembatan', 'panjang', 'lebar', 'kondisi', 'lokasi')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama_jembatan,
                        'panjang' => number_format($item->panjang, 2, ',', '.'),
                        'lebar' => number_format($item->lebar, 2, ',', '.'),
                        'kondisi' => $item->kondisi,
                        'lokasi' => $item->lokasi
                    ];
                });

            $pasar = Pasar::where('iddesa', $request->desa)
                ->select('id', 'nama_pasar', 'panjang', 'lebar', 'kondisi', 'lokasi')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama_pasar,
                        'panjang' => number_format($item->panjang, 2, ',', '.'),
                        'lebar' => number_format($item->lebar, 2, ',', '.'),
                        'kondisi' => $item->kondisi,
                        'lokasi' => $item->lokasi
                    ];
                });
            $pembuanganSampah = PembuanganSampah::where('iddesa', $request->desa)
                ->select('id', 'nama_tempat', 'panjang', 'lebar', 'kondisi', 'lokasi')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama_tempat,
                        'panjang' => number_format($item->panjang, 2, ',', '.'),
                        'lebar' => number_format($item->lebar, 2, ',', '.'),
                        'kondisi' => $item->kondisi,
                        'lokasi' => $item->lokasi
                    ];
                });

            $jalanDesa = JalanDesa::where('iddesa', $request->desa)
                ->select('id', 'nama_jalan', 'panjang', 'lebar', 'kondisi', 'jenis', 'lokasi')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama_jalan,
                        'panjang' => number_format($item->panjang, 2, ',', '.'),
                        'lebar' => number_format($item->lebar, 2, ',', '.'),
                        'kondisi' => $item->kondisi,
                        'jenis' => $item->jenis,
                        'lokasi' => $item->lokasi
                    ];
                });

            $jalanKabupaten = JalanKab::where('iddesa', $request->desa)
                ->select('id', 'nama_jalan', 'panjang', 'lebar', 'kondisi', 'jenis', 'lokasi')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama_jalan,
                        'panjang' => number_format($item->panjang, 2, ',', '.'),
                        'lebar' => number_format($item->lebar, 2, ',', '.'),
                        'kondisi' => $item->kondisi,
                        'jenis' => $item->jenis,
                        'lokasi' => $item->lokasi
                    ];
                });

            $pusatPerdagangan = PusatPerdagangan::where('iddesa', $request->desa)
                ->select('id', 'nama_pusat_perdagangan', 'panjang', 'lebar', 'kondisi', 'lokasi')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama_pusat_perdagangan,
                        'panjang' => number_format($item->panjang, 2, ',', '.'),
                        'lebar' => number_format($item->lebar, 2, ',', '.'),
                        'kondisi' => $item->kondisi,
                        'lokasi' => $item->lokasi
                    ];
                });

            $irigasi = Irigasi::where('iddesa', $request->desa)
                ->select('id', 'nama_irigasi', 'panjang', 'lebar', 'kondisi', 'lokasi')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama_irigasi,
                        'panjang' => number_format($item->panjang, 2, ',', '.'),
                        'lebar' => number_format($item->lebar, 2, ',', '.'),
                        'kondisi' => $item->kondisi,
                        'lokasi' => $item->lokasi
                    ];
                });

            $rumahPotongHewan = RumahPotongHewan::where('iddesa', $request->desa)
                ->select('id', 'nama_rph', 'luas', 'kondisi', 'lokasi')
                ->get()
                ->map(function ($item) {
                    return [
                        'nama' => $item->nama_rph,
                        'luas' => number_format($item->luas, 2, ',', '.'),
                        'kondisi' => $item->kondisi,
                        'lokasi' => $item->lokasi
                    ];
                });

            $infrastruktur[] = [
                'id' => 'pembuangan-sampah',
                'kategori' => 'Pembuangan Sampah',
                'nilai' => $pembuanganSampah->count() . ' Unit',
                'columns' => ['Nama Tempat', 'Panjang (m)', 'Lebar (m)', 'Kondisi', 'Lokasi'],
                'data' => $pembuanganSampah->toArray()
            ];

            $infrastruktur[] = [
                'id' => 'jembatan',
                'kategori' => 'Jembatan',
                'nilai' => $jembatan->count() . ' Unit',
                'columns' => ['Nama Jembatan', 'Panjang (m)', 'Lebar (m)', 'Kondisi', 'Lokasi'],
                'data' => $jembatan->toArray()
            ];

            $infrastruktur[] = [
                'id' => 'pasar',
                'kategori' => 'Pasar',
                'nilai' => $pasar->count() . ' Unit',
                'columns' => ['Nama Pasar', 'Panjang (m)', 'Lebar (m)', 'Kondisi', 'Lokasi'],
                'data' => $pasar->toArray()
            ];

            $infrastruktur[] = [
                'id' => 'jalan-desa',
                'kategori' => 'Jalan Desa',
                'nilai' => $jalanDesa->count() . ' Unit',
                'columns' => ['Nama Jalan', 'Panjang (m)', 'Lebar (m)', 'Kondisi', 'Jenis', 'Lokasi'],
                'data' => $jalanDesa->toArray()
            ];

            $infrastruktur[] = [
                'id' => 'jalan-kabupaten',
                'kategori' => 'Jalan Kabupaten',
                'nilai' => $jalanKabupaten->count() . ' Unit',
                'columns' => ['Nama Jalan', 'Panjang (m)', 'Lebar (m)', 'Kondisi', 'Jenis', 'Lokasi'],
                'data' => $jalanKabupaten->toArray()
            ];

            $infrastruktur[] = [
                'id' => 'pusat-perdagangan',
                'kategori' => 'Pusat Perdagangan',
                'nilai' => $pusatPerdagangan->count() . ' Unit',
                'columns' => ['Nama Pusat Perdagangan', 'Panjang (m)', 'Lebar (m)', 'Kondisi', 'Lokasi'],
                'data' => $pusatPerdagangan->toArray()
            ];

            $infrastruktur[] = [
                'id' => 'irigasi',
                'kategori' => 'Irigasi',
                'nilai' => $irigasi->count() . ' Unit',
                'columns' => ['Nama Irigasi', 'Panjang (m)', 'Lebar (m)', 'Kondisi', 'Lokasi'],
                'data' => $irigasi->toArray()
            ];
            
            $infrastruktur[] = [
                'id' => 'rumah-potong-hewan',
                'kategori' => 'Rumah Potong Hewan',
                'nilai' => $rumahPotongHewan->count() . ' Unit',
                'columns' => ['Nama Rumah Potong Hewan', 'Luas (m2)', 'Kondisi', 'Lokasi'],
                'data' => $rumahPotongHewan->toArray()
            ];

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
            'infrastruktur',
            'pusatPerdagangan',
            'irigasi',
            'rumahPotongHewan'
        ));
    }
}