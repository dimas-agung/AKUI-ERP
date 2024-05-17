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
        //
        Schema::table('cabut_bulu_pengembalians', function (Blueprint $table) {
            $table->string('upah_operator');
            $table->timestamp('waktu_penyebaran');
            $table->integer('lama_pengerjaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
