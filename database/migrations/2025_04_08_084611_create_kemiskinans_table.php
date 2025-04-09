<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kemiskinans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddesa');
            $table->string('nama_program');
            $table->integer('jumlah_penerima');
            $table->timestamps();

            $table->foreign('iddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kemiskinans');
    }
};

