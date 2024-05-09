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
        Schema::create('rambang_kering_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('id_box_hcr_kotor');
            $table->string('jenis_rambang');
            $table->string('berat_masuk');
            $table->string('berat_keluar');
            $table->string('sisa_berat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rambang_kering_stocks');
    }
};
