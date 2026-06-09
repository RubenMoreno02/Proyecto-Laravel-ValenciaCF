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
        Schema::create('estadisticas_partido', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jugador_id')->constrained('jugadores')->onDelete('cascade');
            $table->foreignId('partido_id')->constrained('partidos')->onDelete('cascade');
            $table->unsignedTinyInteger('minutos_jugados')->default(0);
            $table->unsignedTinyInteger('goles')->default(0);
            $table->unsignedTinyInteger('asistencias')->default(0);
            $table->unsignedTinyInteger('amarillas')->default(0);
            $table->unsignedTinyInteger('rojas')->default(0);
            $table->unsignedTinyInteger('faltas_cometidas')->default(0);
            $table->unsignedTinyInteger('faltas_recibidas')->default(0);
            $table->boolean('portero_imbatido')->default(false);
            $table->boolean('titular')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estadisticas_partido');
    }
};
