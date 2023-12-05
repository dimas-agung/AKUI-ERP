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
        Schema::create('transit_pre_cleaning', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_bstb');
            $table->string('nomor_batch');
            $table->string('nama_supplier');
            $table->string('jenis');
            $table->integer('berat');
            $table->integer('pcs');
            $table->integer('kadar_air');
            $table->string('nomor_job');
            $table->integer('modal');
            $table->integer('total_modal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_pre_cleaning');
    }
};
