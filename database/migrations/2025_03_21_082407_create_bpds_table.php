<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bpds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddesa');
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto')->nullable();
            // $table->foreignId('iddesa')->constrained('desa')->onDelete('cascade'); // Menambahkan foreign key
            $table->timestamps();

            $table->foreign('iddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bpds');
    }
};
