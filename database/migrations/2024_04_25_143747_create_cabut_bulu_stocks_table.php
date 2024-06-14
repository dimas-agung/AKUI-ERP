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
        Schema::create('cabut_bulu_stocks', function (Blueprint $table) {
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
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->string('status')->comment('0=Non-Aktif, 1=On Stock, 2=On Process, 3=Finised');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabut_bulu_stocks');
    }
};
