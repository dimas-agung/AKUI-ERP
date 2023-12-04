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
            $table->varchar('jenis');
            $table->varchar('kategori_susut');
            $table->varchar('upah_operator');
            $table->varchar('pengurangan_harga');
            $table->int('harga_estimasi');
            $table->int('status');
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
