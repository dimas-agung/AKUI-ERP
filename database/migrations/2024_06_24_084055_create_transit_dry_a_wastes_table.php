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
        Schema::create('transit_dry_a_wastes', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('jenis_waste');
            $table->float('berat');
            $table->float('pcs');
            $table->string('tujuan_kirim');
            $table->string('nomor_job');
            $table->string('nomor_bstb');
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_dry_a_wastes');
    }
};
