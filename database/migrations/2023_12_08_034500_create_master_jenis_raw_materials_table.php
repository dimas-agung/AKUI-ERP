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
        Schema::create('master_jenis_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('jenis')->unique();
            $table->string('kategori_susut');
            $table->float('upah_operator', 16, 4)->nullable();
            $table->float('pengurangan_harga')->nullable();
            $table->float('harga_estimasi', 16, 4)->nullable();
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jenis_raw_materials');
    }
};