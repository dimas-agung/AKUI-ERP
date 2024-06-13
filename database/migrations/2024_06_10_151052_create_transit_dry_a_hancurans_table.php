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
        Schema::create('transit_dry_a_hancurans', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('jenis_grading');
            $table->float('berat_job');
            $table->string('nomor_job');
            $table->string('nomor_bstb');
            $table->string('tujuan_kirim');
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_dry_a_hancurans');
    }
};
