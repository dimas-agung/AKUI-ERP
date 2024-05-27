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
        Schema::create('cabut_hancuran_persiapans', function (Blueprint $table) {
            $table->id();
            $table->string('id_stock_hcr_kotor');
            $table->string('jenis_rambang');
            $table->float('berat');
            $table->string('nomor_job');
            $table->string('upah_operator');
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
        Schema::dropIfExists('cabut_hancuran_persiapans');
    }
};
