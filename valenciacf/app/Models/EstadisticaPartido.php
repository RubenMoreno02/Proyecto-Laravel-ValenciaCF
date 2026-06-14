<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadisticaPartido extends Model
{
    protected $table = 'estadisticas_partido';

    protected $fillable = [
        'jugador_id', 'partido_id', 'minutos_jugados', 'goles',
        'asistencias', 'amarillas', 'rojas', 'faltas_cometidas',
        'faltas_recibidas', 'portero_imbatido', 'titular', 'mvp'
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }
    
}