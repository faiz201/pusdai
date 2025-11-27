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
        Schema::create('pgh', function (Blueprint $table) {
            $table->id();
            $table->foreignId('satker_id')->constrained('satker')->onDelete('cascade');
            $table->string('dasar_pelaksanaan');
            $table->string('objek_pemantauan');
            $table->string('jenis_dugaan');
            $table->string('penyelesaian')->nullable();
            $table->string('status_terbukti')->nullable();
            $table->string('laporan_hasil')->nullable();
            $table->string('dasar_rekomendasi')->nullable();
            $table->string('jenis_rekomendasi')->nullable();
            $table->string('status_tindak_lanjut')->nullable();
            $table->string('dasar_tindak_lanjut')->nullable();
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
        Schema::dropIfExists('pgh');
    }
};
