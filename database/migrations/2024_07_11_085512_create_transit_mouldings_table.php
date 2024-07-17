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
        Schema::create('transit_mouldings', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_job');
            $table->string('nomor_batch');
            $table->string('tujuan_kirim');
            $table->string('job_order');
            $table->float('berat_job');
            $table->float('pcs_job');
            $table->float('modal_nomor_job', 16, 4);
            $table->float('total_modal_nomor_job', 16, 4);
            $table->float('upah_operator', 16, 4);
            $table->string('nama_operator');
            $table->string('nip_operator');
            $table->string('grade_operator');
            $table->string('nama_team_leader');
            $table->string('keterangan')->nullable();
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_mouldings');
    }
};
