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
        Schema::create('doctor_hours', function (Blueprint $table) {
            $table->id('id'); // Identificador único
            $table->unsignedBigInteger('doctor_id'); // Documento del médico
            $table->string('week_day', 20); // Día de la semana
            $table->time('start_time'); // Hora inicial
            $table->time('end_time'); // Hora final
            $table->integer('duration_minutes'); // Duración de cada cita
            $table->timestamps();

            // Clave foránea
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_hours');
    }
};
