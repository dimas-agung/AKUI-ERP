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
        Schema::create('master_tujuan_kirim_mouldings', function (Blueprint $table) {
            $table->id();
            $table->string('tujuan_kirim');
            $table->string('letak_tujuan');
            $table->string('inisial_tujuan');
            $table->integer('status')->default(1)->comment('0 => STATUS_NON_AKTIF, 1 => STATUS_AKTIF');
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
        Schema::dropIfExists('master_tujuan_kirim_mouldings');
    }
};
