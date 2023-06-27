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
        Schema::create('kamar', function (Blueprint $table) {
            $table->bigInteger('id_kamar')->primary();
            $table->bigInteger('id_transaksi');
            $table->bigInteger('no_kamar');
            $table->bigInteger('harga');
            $table->string('status');
            $table->bigInteger('kapasitas');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamar');
    }
};
