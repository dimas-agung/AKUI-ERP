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
        Schema::create('stock_transit_grading_kasar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomor_bstb');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->float('berat');
            $table->string('kadar_air');
            $table->string('tujuan_kirim');
            $table->string('letak_tujuan');
            $table->string('inisial_tujuan');
            $table->float('modal');
            $table->float('total_modal');
            $table->text('keterangan');
            $table->string('user_created');
            $table->string('user_updated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_transit_grading_kasar');
    }
};