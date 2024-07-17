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
        Schema::create('moulding_waste_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal_moulding');
            $table->string('jenis_waste');
            $table->float('berat');
            $table->float('pcs');
            $table->string('id_box_waste_moulding');
            $table->string('keterangan')->nullable();
            $table->float('harga_estimasi', 16, 4);
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
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
        Schema::dropIfExists('moulding_waste_inputs');
    }
};
