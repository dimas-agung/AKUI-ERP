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
        // Schema::create('master_jenis_grading_warnas', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('jenis');
        //     $table->string('kategori_susut');
        //     $table->float('upah_operator');
        //     $table->float('pengurangan_harga');
        //     $table->float('harga_estimasi');
        //     $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
        //     $table->string('user_created');
        //     $table->string('user_updated')->nullable();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_jenis_grading_warnas');
    }
};
