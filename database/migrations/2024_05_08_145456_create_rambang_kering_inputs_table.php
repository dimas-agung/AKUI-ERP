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
        Schema::create('rambang_kering_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('id_box_hcr_kotor');
            $table->string('jenis_rambang');
            $table->float('berat_basah');
            $table->float('berat_kering');
            $table->float('susut');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('rambang_kering_inputs');
    }
};
