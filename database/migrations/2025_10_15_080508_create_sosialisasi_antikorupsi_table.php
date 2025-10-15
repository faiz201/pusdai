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
            $table->string('jenis_kegiatan');
            $table->string('tema');
            $table->string('waktu');
            $table->string('tempat');
            $table->string('narasumber');
            $table->integer('jumlah_peserta');
            $table->string('sasaran');
            $table->string('indeks_efektivitas');
            $table->text('keterangan');
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
