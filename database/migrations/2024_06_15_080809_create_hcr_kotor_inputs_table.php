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
        Schema::create('hcr_kotor_inputs', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_cabut');
            $table->string('jenis_hcr_kotor');
            $table->float('berat_hcr_kotor');
            $table->string('id_box_hcr_kotor');
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
        Schema::dropIfExists('hcr_kotor_inputs');
    }
};
