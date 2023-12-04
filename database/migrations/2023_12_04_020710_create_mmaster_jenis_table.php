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
        Schema::create('mmaster_jenis', function (Blueprint $table) {
            $table->id();
            $table->date('datetime');
            $table->string('jenis');
            $table->string('kategori_susut');
            $table->string('upah_operator');
            $table->string('pengurangan_harga');
            $table->string('harga_estimasi');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mmaster_jenis');
    }
};
