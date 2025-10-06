<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('patient_id'); // Usuario paciente
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('schedule_id');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled'); // Estado de la cita
            $table->text('notes')->nullable(); // Observaciones
            $table->timestamps();

            // Relaciones
            $table->foreign('patient_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
