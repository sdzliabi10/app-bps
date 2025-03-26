<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'kd_Kategori';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kd_Kategori', 'nama_Kategori'];

    public function dataKategori()
    {
        return $this->hasMany(DataKategori::class, 'kd_Kategori', 'kd_Kategori');
    }
}
