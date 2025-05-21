<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paud;
use Illuminate\Support\Facades\DB;

class PaudSeeder extends Seeder
{
    public function run()
    {
                // Hapus semua data lama
                DB::table('pauds')->truncate();
                
        Paud::create([
            'nama_sekolah' => 'PAUD Tali Asih',
            'nama_desa' => 'Capar',
            'status' => 'Tidak Aktif',
            'jumlah_murid' => 30,
            'latitude' => -7.11491,
            'longitude' => 108.73553,
            'gambar_url' => null, // Gambar dihapus
        ]);

        Paud::create([
            'nama_sekolah' => 'PAUD  UMI KULSUM',
            'nama_desa' => 'Banjaran',
            'status' => 'Tidak Aktif',
            'jumlah_murid' => 30,
            'latitude' => -7.18708,
            'longitude' => 108.79817,
            'gambar_url' => null, // Gambar dihapus
        ]);

        Paud::create([
            'nama_sekolah' => 'PAUD Kb As Shibyan',
            'nama_desa' => 'Pabuaran',
            'status' => 'Tidak Aktif',
            'jumlah_murid' => 30,
            'latitude' => -7.14778,
            'longitude' => 108.80287,
            'gambar_url' => null, // Gambar dihapus
        ]);

        Paud::create([
            'nama_sekolah' => 'PAUD RA Al Ikhlas Pabuaran Salem',
            'nama_desa' => 'Pabuaran',
            'status' => 'Tidak Aktif',
            'jumlah_murid' => 30,
            'latitude' => -7.136124,
            'longitude' =>  108.791914,
            'gambar_url' => null, // Gambar dihapus
        ]);
    }
}