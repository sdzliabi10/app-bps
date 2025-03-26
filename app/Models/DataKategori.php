<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKategori extends Model
{
    use HasFactory;

    protected $table = 'data_kategori';
    protected $fillable = ['kd_Kategori', 'nama_data'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kd_Kategori', 'kd_Kategori');
    }
}
