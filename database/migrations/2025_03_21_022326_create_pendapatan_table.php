<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pendapatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('iddesa'); // Menambahkan kolom iddesa
            $table->string('sumber_pendapatan');  // Nama sumber pendapatan (misalnya pajak, hibah)
            $table->decimal('jumlah', 15, 2);     // Jumlah pendapatan
            $table->timestamps();                 // Kolom created_at dan updated_at
    
            // Menambahkan foreign key constraint untuk iddesa
            $table->foreign('iddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendapatans');
    }
};
