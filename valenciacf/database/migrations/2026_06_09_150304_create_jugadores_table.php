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
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->unsignedTinyInteger('dorsal');
            $table->enum('posicion', ['Portero', 'Defensa', 'Medio', 'Delantero']);
            $table->string('nacionalidad', 60);
            $table->date('fecha_nacimiento');
            $table->unsignedSmallInteger('altura_cm')->nullable();
            $table->decimal('peso_kg', 4, 1)->nullable();
            $table->date('fecha_incorporacion');
            $table->boolean('activo')->default(true);
            $table->string('foto_url', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jugadores');
    }
};
