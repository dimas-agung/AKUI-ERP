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
        Schema::create('prm_raw_material_input_items', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no')->default('1');
            $table->string('jenis');
            $table->float('berat_nota');
            $table->float('berat_kotor');
            $table->float('berat_bersih');
            $table->float('selisih_berat');
            $table->float('kadar_air');
            $table->string('id_box');
            $table->float('harga_nota');
            $table->float('total_harga_nota');
            $table->float('harga_deal');
            $table->text('keterangan_item');
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
        Schema::dropIfExists('prm_raw_material_input_items');
    }
};
