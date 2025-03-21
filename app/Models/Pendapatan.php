<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendapatan extends Model
{
    use HasFactory;

    protected $table = 'pendapatans';

    protected $fillable = [
        'iddesa',
        'sumber_pendapatan',
        'jumlah'
    ];

    // Relasi ke tabel Desa
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa');
    }
}
