<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaudsTable extends Migration
{
    public function up()
    {
        Schema::create('pauds', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('nama_desa');
            $table->string('status')->nullable();
            $table->integer('jumlah_murid')->nullable();
            $table->decimal('latitude', 10, 6);  // Koordinat latitude
            $table->decimal('longitude', 10, 6); // Koordinat longitude
            $table->string('gambar_url')->nullable(); // URL gambar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pauds');
    }
}
