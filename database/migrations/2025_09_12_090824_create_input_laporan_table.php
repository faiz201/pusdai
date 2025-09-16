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
        Schema::create('input_laporan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seksi');
            $table->unsignedBigInteger('user_id');
            $table->string('judul_laporan')->unique();
            $table->text('detail');
            $table->string('status')->default('0');
            $table->timestamps();

            $table->foreign('seksi')->references('id')->on('monitoring')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('input_laporans');
    }
};