<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('doctor_id');
            $table->string('day_of_week', 20); // Día de la semana
            $table->time('start_time'); // Hora de inicio
            $table->time('end_time');   // Hora de fin
            $table->boolean('status')->default(true); // Disponibilidad
            $table->timestamps();

            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
