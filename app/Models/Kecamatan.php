<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;

    protected $table = 'kecamatan';
    protected $primaryKey = 'kdkec';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['kdkec', 'nmkec'];

    public function desa()
    {
        return $this->hasMany(Desa::class, 'kdkec', 'kdkec');
    }
}
