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
        Schema::create('stock_hcr_kotors', function (Blueprint $table) {
            $table->id();
            $table->string('id_box_hcr_kotor');
            $table->timestamp('tanggal_cabut');
            $table->string('jenis_hcr_kotor');
            $table->float('berat_masuk');
            $table->float('berat_keluar');
            $table->float('sisa_berat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_hcr_kotors');
    }
};
