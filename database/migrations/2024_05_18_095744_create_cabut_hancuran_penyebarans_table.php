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
        Schema::create('cabut_hancuran_penyebarans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->string('jenis_rambang');
            $table->string('upah_operator');
            $table->float('berat');
            $table->string('nama_operator');
            $table->string('nip_operator');
            $table->string('grade_operator');
            $table->string('nama_team_leader');
            $table->timestamp('waktu_penyebaran');
            $table->string('status')->default('1');
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
        Schema::dropIfExists('cabut_hancuran_penyebarans');
    }
};
