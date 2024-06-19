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
        Schema::create('rambang_basah_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('id_box_hcr_kotor');
            $table->date('tanggal_cabut');
            $table->string('jenis_hcr_kotor');
            $table->float('berat_hcr_kotor');
            $table->string('jenis_rambang');
            $table->float('berat');
            $table->string('keterangan')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('rambang_basah_inputs');
    }
};
