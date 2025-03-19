<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerangkatDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data dummy untuk perangkat desa
        DB::table('perangkat_desas')->insert([
            [
                'iddesa' => 3329010001,  // Pastikan ini sesuai dengan data yang ada di tabel 'desa'
                'nama' => 'John Doe',
                'jabatan' => 'Kepala Desa',
                'foto' => 'path_to_image.jpg',  // Bisa sesuaikan dengan path yang sesuai
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'iddesa' => 3329010001,
                'nama' => 'Jane Smith',
                'jabatan' => 'Sekretaris Desa',
                'foto' => 'path_to_image2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
