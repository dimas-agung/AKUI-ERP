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
        Schema::table('cabut_hancuran_pengembalians', function (Blueprint $table) {
            $table->timestamp('waktu_penyebaran')->nullable()->change();
            $table->timestamp('waktu_pengembalian')->nullable()->change();
            $table->integer('lama_pengerjaan')->change();
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
