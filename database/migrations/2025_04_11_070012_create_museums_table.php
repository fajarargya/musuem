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
        Schema::create('museums', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('provinsi');
            $table->string('kota');
            $table->integer('jumlah_koleksi');
            $table->string('jenis_pemilik');
            $table->string('pemilik');
            $table->string('tipe_akhir');
            $table->string('nomor_pendaftaran')->nullable();
            $table->string('gambar')->nullable(); // Untuk upload gambar nanti
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('museums');
    }
};
