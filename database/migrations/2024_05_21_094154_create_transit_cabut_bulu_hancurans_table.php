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
        Schema::create('transit_cabut_bulu_hancurans', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_job');
            $table->string('jenis_rambang');
            $table->string('upah_operator');
            $table->float('berat');
            $table->string('nama_operator');
            $table->string('nip_operator');
            $table->string('grade_operator');
            $table->string('nama_team_leader');
            $table->date('waktu_penyebaran');
            $table->date('waktu_pengembalian');
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transit_cabut_bulu_hancurans');
    }
};
