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
        // Schema::create('moulding_stocks', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('unit');
        //     $table->string('nomor_job');
        //     $table->string('nomor_batch');
        //     $table->string('tujuan_kirim');
        //     $table->string('job_order');
        //     $table->float('berat_job');
        //     $table->float('pcs_job');
        //     $table->float('modal_nomor_job', 16, 4);
        //     $table->float('total_modal_nomor_job', 16, 4);
        //     $table->float('upah_operator', 16, 4);
        //     $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_ON_STOCK, 2 => STATUS_ON_PROSES, 3 => STATUS_FINISHED');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moulding_stocks');
    }
};
