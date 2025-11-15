<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Agrega la columna 'date' para permitir agendas por fecha específica
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_hours', function (Blueprint $table) {
            // Fecha de la agenda (opcional) e indexada para búsquedas
            $table->date('date')->nullable()->index();
        });
    }

    public function down(): void
    {
        Schema::table('doctor_hours', function (Blueprint $table) {
            // Reversión: elimina la columna 'date'
            $table->dropColumn('date');
        });
    }
};