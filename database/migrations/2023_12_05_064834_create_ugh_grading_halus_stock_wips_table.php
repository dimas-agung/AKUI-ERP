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
        Schema::create('ugh_grading_halus_stock_wip', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->integer('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->string('berat');
            $table->string('pcs');
            $table->string('kadar_air');
            $table->string('modal');
            $table->string('total_modal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ugh_grading_halus_stock_wip');
    }
};
