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
        Schema::create('pemantauan_zona_integritas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('satker_id')->constrained('satker')->onDelete('cascade');
            $table->string('tahun_predikat')->nullable();
            $table->boolean('pemeliharaan_wbk')->default(false);
            $table->boolean('pencanangan_wbbm')->default(false);
            $table->boolean('proses_penilaian_wbbm')->default(false);
            $table->string('predikat_wbbm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemantauan_zona_integritas');
    }
};
