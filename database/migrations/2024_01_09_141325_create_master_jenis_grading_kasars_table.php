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
        Schema::create('master_jenis_grading_kasars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori_susut')->nullable();
            $table->float('upah_operator')->nullable();
            $table->float('presentase_pengurangan_harga')->nullable();
            $table->float('harga_estimasi');
            $table->integer('status')->default('1');
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jenis_grading_kasars');
    }
};
