<?php

// app/Models/Kelembagaan.php

namespace App\Models;

use App\Models\Desa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelembagaan extends Model
{
    use HasFactory;

    protected $table = 'kelembagaans';

    protected $fillable = [
        'iddesa',
        'jenis',
        'jumlah_pengurus',
        'jumlah_anggota',
        'jumlah_kegiatan',
        'jumlah_buku_administrasi',
        'jumlah_dana',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa');
    }
}
