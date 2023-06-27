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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->bigInteger('id_transaksi')->primary();
            $table->bigInteger('id_user');
            $table->bigInteger('id_kamar');
            $table->bigInteger('total_harga');
            $table->string('status', 15);
            $table->dateTime('check_in_at');
            $table->dateTime('check_out_at');
            $table->bigInteger('lama_penginapan');
            $table->timestamps();
        });

        Schema::table('transaksi', function (Blueprint $table) {
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_kamar')->references('id_kamar')->on('kamar')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
