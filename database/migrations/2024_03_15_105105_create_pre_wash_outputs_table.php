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
        Schema::create('pre_wash_outputs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job')->unique();
            $table->string('nomor_batch');
            $table->string('jenis_job');
            $table->integer('status')->default('1');
            $table->float('berat_job');
            $table->float('pcs_job');
            $table->string('tujuan_kirim');
            $table->string('keterangan')->nullable();
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->string('operator_perendaman');
            $table->string('operator_bilas');
            $table->string('operator_box');
            $table->string('nomor_bstb');
            $table->string('user_created');
            $table->string('user_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_wash_outputs');
    }
};
