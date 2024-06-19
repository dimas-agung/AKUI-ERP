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
        Schema::create('dry_a_penerimaan_hancuran_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_job');
            $table->string('jenis_rambang');
            $table->float('upah_operator', 16, 4);
            $table->float('berat');
            $table->string('nama_operator');
            $table->string('nip_operator');
            $table->string('grade_operator');
            $table->string('nama_team_leader');
            $table->timestamp('waktu_penyebaran')->nullable();
            $table->timestamp('waktu_pengembalian')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dry_a_penerimaan_hancuran_stocks');
    }
};
