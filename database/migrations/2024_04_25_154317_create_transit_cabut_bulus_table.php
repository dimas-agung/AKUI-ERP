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
        Schema::create('transit_cabut_bulus', function (Blueprint $table) {
            $table->id();
            $table->string('workstation');
            $table->string('unit');
            $table->string('nomor_job');
            $table->string('nomor_batch');
            $table->string('jenis_job');
            $table->float('berat_job');
            $table->float('pcs_job');
            $table->string('tujuan_kirim');
            $table->string('keterangan')->nullable();
            $table->string('upah_operator');
            $table->string('nama_operator');
            $table->string('nip_operator');
            $table->string('grade_operator');
            $table->string('nama_team_leader');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->integer('status')->default(3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_cabut_bulus');
    }
};
