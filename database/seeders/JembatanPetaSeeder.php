<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Jembatan_peta;

class JembatanPetaSeeder extends Seeder
{
    /**
     * Jalankan seeder database untuk tabel jembatan_peta.
     */
    public function run(): void
    {
        DB::table('jembatan_peta')->truncate();

        Jembatan_peta::create([
            'iddesa' =>  3329170016,
            'nama' => 'Jembatan Tengglog',
            'lokasi' => 'Jl. Kh. Hasyim Ashari, Limbangan Wetan, Kec. Brebes, Kabupaten Brebes, Jawa Tengah 52219',
            'panjang' => 50,
            'lebar' => 5,
            'konstruksi' => 'Beton',
            'tahun_dibangun' => 2010,
            'latitude' => -6.8653101283249205, 
            'longitude' => 109.05803919011014, 
            'gambar' => '/images/jembatantengglog (2).png',
        ]);

        Jembatan_peta::create([
            'iddesa' =>  3329170009,
            'nama' => 'Jembatan Kali Pemali',
            'lokasi' => 'Jl. Raya Pantura, Kec. Brebes, Kabupaten Brebes, Jawa Tengah',
            'panjang' => 50,
            'lebar' => 5,
            'konstruksi' => 'Beton',
            'tahun_dibangun' => 2023,
            'latitude' => -6.867440505354717,  
            'longitude' => 109.03409242775585,
            'gambar' => '/images/jembatan1.jpg',
        ]);
    }
}
