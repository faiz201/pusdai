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
        Schema::create('penanganan_laporan_gratifikasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('satker_id')->constrained('satker')->onDelete('cascade');
            $table->string('nomor_sig')->nullable();
            $table->string('jenis')->nullable();
            $table->string('bentuk_pemberian')->nullable();
            $table->string('objek_penanganan')->nullable();
            $table->decimal('nilai_taksiran', 15, 2)->nullable();
            $table->string('kategori_pemberi')->nullable();
            $table->string('proses_bisnis')->nullable();
            $table->string('status_kpk')->nullable();
            $table->string('nomor_sk')->nullable();
            $table->string('tindak_lanjut')->nullable();
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
        Schema::dropIfExists('penanganan_laporan_gratifikasi');
    }
};
