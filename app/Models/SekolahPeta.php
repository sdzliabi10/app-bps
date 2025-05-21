<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SekolahPeta extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'sekolah_peta';

    // Kolom yang dapat diisi
    protected $fillable = [
        'iddesa',
        'nama_sekolah',
        'jenjang',
        'alamat',
        'tahun_berdiri',
        'status',
        'jumlah_murid',
        'jumlah_guru',
        'latitude',
        'longitude',
        'gambar',
    ];

    // Definisikan relasi ke model Desa (relasi banyak ke satu)
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa', 'iddesa');
    }
}
