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
        Schema::create('dry_a_penerimaan_hancurans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->string('jenis_rambang');
            $table->float('upah_operator', 16, 4);
            $table->string('berat');
            $table->string('nama_operator');
            $table->string('nip_operator');
            $table->string('grade_operator');
            $table->string('nama_team_leader');
            $table->date('waktu_penyebaran');
            $table->date('waktu_pengembalian');
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
        Schema::dropIfExists('dry_a_penerimaan_hancurans');
    }
};
