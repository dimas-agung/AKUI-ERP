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
        Schema::create('moulding_persiapans', function (Blueprint $table) {
            $table->id();
            $table->string('id_box_grading_warna');
            $table->string('nomor_batch');
            $table->string('tujuan_kirim');
            $table->string('jenis_grading');
            $table->float('job_order');
            $table->float('berat_job');
            $table->float('pcs_job')->nullable();
            $table->string('nomor_job');
            $table->float('biaya_produksi')->nullable();
            $table->float('upah_operator', 16, 4)->nullable();
            $table->float('modal_per_jenis', 16, 4);
            $table->float('total_modal_per_jenis', 16, 4);
            $table->float('modal_nomor_job', 16, 4);
            $table->float('total_modal_nomor_job', 16, 4);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('moulding_persiapans');
    }
};
