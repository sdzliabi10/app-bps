<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TempatIbadah;
use Illuminate\Support\Facades\DB;

class TempatIbadahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tempat_ibadah')->truncate();

        TempatIbadah::create([
            'iddesa' => 3329032001,
            'nama' => 'Masjid Baitul Abidin',
            'agama' => 'Islam',
            'alamat' => 'Limbangan Kulon, Kec. Brebes, Kabupaten Brebes, Jawa Tengah 52219',
            'tahun_berdiri' => 1995,
            'latitude' => -6.873418825314879, 
            'longitude' => 109.05560642481474,
            'gambar' => '/images/masjid.jpg',
        ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170017,
        //     'nama' => 'Musola Alhidayah',
        //     'agama' => 'Islam',
        //     'alamat' => 'Gg. Bugenvil Desa, RT.004/RW.002, Limbangan Kulon, Kabupaten Brebes, Jawa Tengah 52219',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.873438797303991, 
        //     'longitude' => 109.05681341886918,
        //     'gambar' => '/images/masjid.jpg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170017,
        //     'nama' => 'Musola Baiturohman',
        //     'agama' => 'Islam',
        //     'alamat' => 'Limbangan Kulon, Kabupaten Brebes, Jawa Tengah 52219',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.872241807955248,
        //     'longitude' => 109.05642181635193,
        //     'gambar' => '/images/masjid.jpg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170017,
        //     'nama' => 'Mushola Baitul Islam',
        //     'agama' => 'Islam',
        //     'alamat' => 'Limbangan Kulon, Kabupaten Brebes, Jawa Tengah 52219',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.869901079262153, 
        //     'longitude' =>  109.05729353428515,
        //     'gambar' => '/images/masjid.jpg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170017,
        //     'nama' => 'Musala Mutmainah',
        //     'agama' => 'Islam',
        //     'alamat' => 'Limbangan Kulon, Kabupaten Brebes, Jawa Tengah 52219',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.86927, 
        //     'longitude' =>  109.05742,
        //     'gambar' => '/images/masjid.jpg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170017,
        //     'nama' => 'Musolah Babujibril',
        //     'agama' => 'Islam',
        //     'alamat' => 'Limbangan Kulon, Kabupaten Brebes, Jawa Tengah 52219',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.86884, 
        //     'longitude' =>  109.05718,
        //     'gambar' => '/images/masjid.jpg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170017,
        //     'nama' => 'Masjid jami Baitul Mamur',
        //     'agama' => 'Islam',
        //     'alamat' => 'Limbangan Kulon, Kabupaten Brebes, Jawa Tengah 52219',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.868318950508673, 
        //     'longitude' =>  109.0566648915484,
        //     'gambar' => '/images/baitulmakmur.jpg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170009,
        //     'nama' => 'Gereja Katolik Santa Maria Fatima, Brebes',
        //     'agama' => 'Katolik',
        //     'alamat' => 'Brebes, Kec.Brebes, Kabupaten Brebes, Jawa Tengah',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.871648957459583,
        //     'longitude' =>  109.04700558627428,
        //     'gambar' => '/images/santamaria.jpeg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170009,
        //     'nama' => 'Gereja Bethel Indonesia Batu Penjuru Kota Brebes',
        //     'agama' => 'Kristen',
        //     'alamat' => 'Brebes, Kec.Brebes, Kabupaten Brebes, Jawa Tengah',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.870051189718486,
        //     'longitude' =>  109.04754202808329,
        //     'gambar' => '/images/masjid.jpg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170009,
        //     'nama' => 'GKJ Brebes',
        //     'agama' => 'Kristen',
        //     'alamat' => 'Brebes, Kec.Brebes, Kabupaten Brebes, Jawa Tengah',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.87030683291784,
        //     'longitude' =>   109.04835741963298,
        //     'gambar' => '/images/masjid.jpg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170009,
        //     'nama' => 'Gereja Bethel Maranatha Brebes',
        //     'agama' => 'Kristen',
        //     'alamat' => 'Brebes, Kec.Brebes, Kabupaten Brebes, Jawa Tengah',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.869058254342235,
        //     'longitude' => 109.03636828075035,
        //     'gambar' => '/images/masjid.jpg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329170009,
        //     'nama' => 'Klenteng Hok Tek Bio',
        //     'agama' => 'Konghucu',
        //     'alamat' => 'Brebes, Kec.Brebes, Kabupaten Brebes, Jawa Tengah',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.86850430406331, 
        //     'longitude' => 109.0350808190939,
        //     'gambar' => '/images/kelenteng.jpeg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329100016,
        //     'nama' => 'Vihara Dharma Mulya Losari',
        //     'agama' => 'Buddha',
        //     'alamat' => 'Losari Lor, Kec. Losari, Kabupaten Brebes, Jawa Tengah',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.81300, 
        //     'longitude' => 108.82228, 
        //     'gambar' => '/images/vihara.jpeg',
        // ]);

        // TempatIbadah::create([
        //     'iddesa' => 3329100016,
        //     'nama' => 'Kelenteng Hok Tek Bio Losari (廟德福)',
        //     'agama' => 'Konghucu',
        //     'alamat' => 'Losari Lor, Kec. Losari, Kabupaten Brebes, Jawa Tengah',
        //     'tahun_berdiri' => 1995,
        //     'latitude' => -6.81573,
        //     'longitude' => 108.80854, 
        //     'gambar' => '/images/masjid.jpg',
        // ]);
    }
}
