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
        Schema::create('transit_final_gradings', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_job');
            $table->string('nomor_batch');
            $table->string('tujuan_kirim');
            $table->string('job_order');
            $table->string('jenis_grading');
            $table->float('berat_grading');
            $table->float('pcs_grading')->nullable();
            $table->float('modal_per_jenis', 16, 4);
            $table->float('total_modal_per_jenis', 16, 4);
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_final_gradings');
    }
};
