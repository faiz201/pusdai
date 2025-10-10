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
            $table->foreignId('nama satker')->constrained('satker')->onDelete('cascade');
            $table->string('periode');
            $table->integer('indeks_pelaksanaan_dalam_setahun')->default(0);
            $table->integer('indeks_peserta_kegiatan')->default(0);
            $table->integer('output_project_learning')->default(0);
            $table->integer('indeks_total')->default(0);
            $table->string('kesimpulan')->nullable();
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
