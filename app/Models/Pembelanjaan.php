<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelanjaan extends Model
{
    use HasFactory;

    protected $table = 'pembelanjaans';

    protected $fillable = [
        'iddesa', 
        'jenis_pengeluaran', 
        'jumlah'
    ];

    // Relasi ke tabel Desa
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'iddesa');
    }
}
