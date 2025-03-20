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
        Schema::create('profil_desas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kddesa'); // Sesuai dengan iddesa di desa
            $table->text('visi');
            $table->text('misi');
            $table->text('program_unggulan');
            $table->text('batas_wilayah');
            $table->string('alamat');
            $table->string('kontak');
            $table->string('foto')->nullable();
            $table->timestamps();
        
            // Foreign key harus mengarah ke 'iddesa' di 'desa'
            $table->foreign('kddesa')->references('iddesa')->on('desa')->onDelete('cascade');
        });        
        
    }

    /**
     * Reverse the migrations.s
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_desas');
    }
};
