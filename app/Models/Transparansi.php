<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transparansi extends Model
{
    use HasFactory;

    protected $table = 'transparansis';

    protected $fillable = [
        'iddesa',
        'jenis',
        'judul',
        'nomor',
        'tanggal',
        'nama',
        'sumber',
        'anggaran',
        'file'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'anggaran' => 'decimal:2'
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa', 'iddesa');
    }
}


