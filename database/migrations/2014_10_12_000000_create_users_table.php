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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('role', 11);
            $table->string('nama', 50);
            $table->string('email', 50);
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('no_hp', 50);
            $table->enum('jenis_kelamin', ['perempuan', 'laki-laki']);
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
