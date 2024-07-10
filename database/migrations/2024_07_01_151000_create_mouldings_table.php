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
        Schema::create('mouldings', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_job');
            $table->string('nomor_batch');
            $table->string('tujuan_kirim');
            $table->string('job_order');
            $table->float('berat_job');
            $table->float('pcs_job')->nullable();
            $table->float('upah_operator', 16, 4);
            $table->float('modal_nomor_job', 16, 4);
            $table->float('total_modal_nomor_job', 16, 4);
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
        Schema::dropIfExists('mouldings');
    }
};
