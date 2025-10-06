<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('specialty_id');
            $table->string('license_number', 50); // Número de licencia médica
            $table->unsignedBigInteger('user_id'); // Relación con tabla users
            $table->timestamps();

            // Claves foráneas
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
