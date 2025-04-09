<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sarana_kesehatan', function (Blueprint $table) {
            $table->id();
            $table->string('kdkec');
            $table->string('iddesa')->nullable();
            $table->integer('tahun');
            $table->integer('puskesmas')->default(0);
            $table->integer('pustu')->default(0);
            $table->integer('polindes')->default(0);
            $table->integer('posyandu')->default(0);
            $table->integer('posyandu_lansia')->default(0);
            $table->integer('pos_kesehatan')->default(0);
            $table->integer('rumah_sakit')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sarana_kesehatan');
    }
};