<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Jugador extends Model
{
    protected $table = 'jugadores';
    
    protected $fillable = [
        'nombre', 'dorsal', 'posicion', 'nacionalidad',
        'fecha_nacimiento', 'altura_cm', 'peso_kg',
        'fecha_incorporacion', 'activo', 'foto_url'
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_incorporacion' => 'date',
        'activo' => 'boolean',
    ];

    // Relaciones
    public function estadisticas()
    {
        return $this->hasMany(EstadisticaPartido::class);
    }

    public function lesiones()
    {
        return $this->hasMany(Lesion::class);
    }

    public function partidos()
    {
        return $this->belongsToMany(Partido::class, 'estadisticas_partido')
                    ->withPivot('minutos_jugados', 'goles', 'asistencias',
                                'amarillas', 'rojas', 'titular');
    }

    // Accessor: edad calculada dinámicamente
    public function getEdadAttribute(): int
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }
}