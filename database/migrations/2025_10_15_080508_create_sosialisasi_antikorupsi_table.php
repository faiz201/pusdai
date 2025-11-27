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
        Schema::create('sosialisasi_antikorupsi', function (Blueprint $table) {
            $table->id();
            $table->string('periode');
            $table->unsignedBigInteger('satker_id');
            $table->string('jenis_kegiatan')->nullable();
            $table->string('tema')->nullable();
            $table->string('waktu')->nullable();
            $table->string('tempat')->nullable();
            $table->string('narasumber')->nullable();
            $table->integer('jumlah_peserta')->nullable();
            $table->string('kategori_peserta')->nullable();
            $table->string('sasaran')->nullable();
            $table->string('indeks_efektivitas')->nullable();
            $table->text('keterangan')->nullable();

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
        Schema::dropIfExists('sosialisasi_antikorupsi');
    }
};
