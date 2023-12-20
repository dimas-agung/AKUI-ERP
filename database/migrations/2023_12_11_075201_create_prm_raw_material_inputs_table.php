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
        Schema::create('prm_raw_material_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no')->default('1');
            $table->string('nomor_po');
            $table->string('nomor_batch');
            $table->string('nomor_nota_supplier');
            $table->string('nomor_nota_internal');
            $table->string('nama_supplier');
            $table->text('keterangan');
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
        Schema::dropIfExists('prm_raw_material_inputs');
    }
};
