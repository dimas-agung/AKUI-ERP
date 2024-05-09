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
        Schema::create('input_rambang_basahs', function (Blueprint $table) {
            $table->id();
            $table->string('id_box_hcr_kotor');
            $table->timestamp('tanggal_cabut');
            $table->string('jenis_hcr_kotor');
            $table->float('berat_hcr_kotor');
            $table->string('jenis_rambang');
            $table->float('berat');
            $table->string('keterangan')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('input_rambang_basahs');
    }
};
