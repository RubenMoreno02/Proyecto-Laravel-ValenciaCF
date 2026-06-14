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
        Schema::table('lesiones', function (Blueprint $table) {
            $table->string('parte_cuerpo', 80)->nullable()->after('tipo_lesion');
            $table->integer('dias_estimados')->nullable()->after('fecha_estimada_vuelta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lesiones', function (Blueprint $table) {
            $table->dropColumn(['parte_cuerpo', 'dias_estimados']);
        });
    }
};
