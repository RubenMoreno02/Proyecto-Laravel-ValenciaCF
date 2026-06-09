<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    protected $fillable = [
        'rival', 'fecha', 'competicion', 'jornada',
        'sede', 'goles_favor', 'goles_contra', 'estadio'
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function estadisticas()
    {
        return $this->hasMany(EstadisticaPartido::class);
    }

    public function jugadores()
    {
        return $this->belongsToMany(Jugador::class, 'estadisticas_partido')
                    ->withPivot('minutos_jugados', 'goles', 'asistencias',
                                'amarillas', 'rojas', 'titular');
    }

    // Accessor: resultado del partido
    public function getResultadoAttribute(): string
    {
        if ($this->goles_favor > $this->goles_contra) return 'Victoria';
        if ($this->goles_favor < $this->goles_contra) return 'Derrota';
        return 'Empate';
    }
}