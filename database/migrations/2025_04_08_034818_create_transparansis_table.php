<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transparansis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddesa');
            $table->enum('jenis', ['peraturan', 'edaran', 'program']);
            
            // Fields for Peraturan & Edaran
            $table->string('judul')->nullable();
            $table->string('nomor')->nullable();
            $table->date('tanggal')->nullable();
            
            // Fields for Program
            $table->string('nama')->nullable();
            $table->enum('sumber', ['pusat', 'provinsi', 'kabupaten'])->nullable();
            
            $table->timestamps();
            
            $table->foreign('iddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transparansis');
    }
};