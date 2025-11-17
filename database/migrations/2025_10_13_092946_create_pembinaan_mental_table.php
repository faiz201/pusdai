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
        Schema::create('pembinaan_mental', function (Blueprint $table) {
            $table->id();

            // Relasi
            $table->unsignedBigInteger('satker_id');

            // Rencana Kegiatan
            $table->string('periode'); 
            $table->string('program_kegiatan')->nullable();
            $table->string('ruang_lingkup')->nullable();
            $table->string('waktu')->nullable();
            $table->string('tema')->nullable();
            $table->string('tempat')->nullable();

            // Realisasi Kegiatan
            $table->string('waktu_pelaksanaan')->nullable();
            $table->string('peran_pejabat_administrator')->nullable();
            $table->text('narasi_singkat_peran')->nullable();
            $table->integer('jumlah_peserta')->nullable();
            $table->string('output_manfaat')->nullable();
            $table->string('link_dokumentasi')->nullable();

            // Kertas Aplikasi (Auto-Hitung)
            $table->integer('indeks_pelaksanaan_dalam_setahun');
            $table->integer('indeks_peserta_kegiatan');
            $table->integer('output_project_learning');
            $table->integer('indeks_total');
            $table->string('kesimpulan');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembinaan_mental');
    }
};
