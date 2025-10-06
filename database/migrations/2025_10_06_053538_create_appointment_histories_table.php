<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointment_history', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('appointment_id');
            $table->string('action', 100); // Acción realizada (Creación, Modificación, Cancelación)
            $table->dateTime('action_date');
            $table->unsignedBigInteger('user_responsible'); // Usuario responsable del cambio
            $table->timestamps();

            // Relaciones
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('user_responsible')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointment_history');
    }
};
