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
        Schema::create('moulding_waste_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('id_box_waste_moulding');
            $table->string('jenis_waste');
            $table->float('berat_masuk');
            $table->float('pcs_masuk');
            $table->float('berat_keluar');
            $table->float('pcs_keluar');
            $table->float('sisa_berat');
            $table->float('sisa_pcs');
            $table->float('modal', 16, 4);
            $table->float('total_modal', 16, 4);
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
        Schema::dropIfExists('moulding_waste_stocks');
    }
};
