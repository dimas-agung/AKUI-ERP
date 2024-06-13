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
        Schema::create('dry_a_grading_hancurans', function (Blueprint $table) {
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
            $table->timestamp('waktu_pengembalian');
            $table->string('jenis_grading');
            $table->float('berat_grading');
            $table->float('kontribusi', 16, 4);
            $table->float('susut_belakang', 16, 4);
            $table->integer('status')->default(1);
            $table->string('user_created')->nullable();
            $table->string('user_updated')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dry_a_grading_hancurans');
    }
};
