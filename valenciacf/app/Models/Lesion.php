<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesion extends Model
{
    protected $fillable = [
        'jugador_id', 'tipo_lesion', 'fecha_inicio',
        'fecha_estimada_vuelta', 'estado', 'observaciones'
    ];

    protected $table = 'lesiones';

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_estimada_vuelta' => 'date',
    ];

    public function jugador()
    {
        return $this->belongsTo(Jugador::class);
    }

    // Scope: solo lesiones activas
    public function scopeActivas($query)
    {
        return $query->where('estado', '!=', 'Recuperado');
    }
}