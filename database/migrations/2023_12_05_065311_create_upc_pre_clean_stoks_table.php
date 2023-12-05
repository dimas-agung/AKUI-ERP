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
        Schema::create('upc_pre_clean_stok', function (Blueprint $table) {
            $table->string('unit');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->integer('berat');
            $table->integer('pcs');
            $table->integer('kadar_air');
            $table->integer('modal');
            $table->integer('total_modal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upc_pre_clean_stok');
    }
};
