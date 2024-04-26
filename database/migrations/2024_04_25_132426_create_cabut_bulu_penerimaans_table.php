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
        Schema::create('cabut_bulu_penerimaans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->string('nomor_batch');
            $table->string('jenis_job');
            $table->float('berat_job');
            $table->float('pcs_job');
            $table->string('tujuan_kirim');
            $table->string('keterangan')->nullable();
            $table->string('nomor_bstb');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->string('user_created');
            $table->string('user_updated');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cabut_bulu_penerimaans');
    }
};
