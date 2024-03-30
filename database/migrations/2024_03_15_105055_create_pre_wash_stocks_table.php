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
        Schema::create('pre_wash_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('nomor_job')->unique();
            $table->string('nomor_batch');
            $table->integer('status')->default('1');
            $table->string('jenis_job');
            $table->float('berat_job');
            $table->float('pcs_job');
            $table->string('tujuan_kirim');
            $table->string('keterangan')->nullable();
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
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
        Schema::dropIfExists('pre_wash_stocks');
    }
};
