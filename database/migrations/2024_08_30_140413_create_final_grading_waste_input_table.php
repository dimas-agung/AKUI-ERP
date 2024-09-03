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
        Schema::create('final_grading_waste_inputs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_grading');
            $table->string('nomor_batch');
            $table->string('tujuan_kirim');
            $table->string('nomor_job');
            $table->string('jenis_waste');
            $table->string('job_order');
            $table->float('berat');
            $table->float('pcs')->default(0)->nullable();
            $table->float('harga_estimasi');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_grading_wastes');
    }
};