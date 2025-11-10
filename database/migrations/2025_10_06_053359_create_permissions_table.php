<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 100); // Nombre del permiso (ejemplo: "edit_user")
            $table->string('slug', 64); // Accion que representa el permiso (ejemplo: "edit-user")
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
