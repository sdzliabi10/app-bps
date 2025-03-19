<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kdkec' => '010', 'nmkec' => 'SALEM'],
            ['kdkec' => '020', 'nmkec' => 'BANTARKAWUNG'],
            ['kdkec' => '030', 'nmkec' => 'BUMIAYU'],
            ['kdkec' => '040', 'nmkec' => 'PAGUYANGAN'],
        ];

        DB::table('kecamatan')->insert($data);
    }
}
