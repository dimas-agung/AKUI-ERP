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
        Schema::create('master_jenis_raw_material', function (Blueprint $table) {
            $table->id();
            $table->date('datetime');
            $table->string('jenis');
            $table->string('kategori_susut');
            $table->integer('upah_operator');
            $table->integer('pengurangan_harga');
            $table->integer('harga_estimasi');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jenis_raw_material');
    }
};
