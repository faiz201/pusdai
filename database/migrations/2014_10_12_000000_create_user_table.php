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
        Schema::create('user', function (Blueprint $table) { 
            $table->id(); 
            $table->string('nama'); 
            $table->string('email')->unique(); 
            $table->enum('role', [0, 1])->default(0); // 0 = Super Admin, 1 =Admin 
            $table->boolean('status'); //  0 = Belum aktif, 1=Aktif 
            $table->string('password'); 
            $table->string('foto')->nullable(); 
            $table->timestamps(); 
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
