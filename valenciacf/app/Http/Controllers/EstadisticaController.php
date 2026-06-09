<?php
namespace App\Http\Controllers;

use App\Models\Jugador;

class EstadisticaController extends Controller
{
    public function index()
    {
        $jugadores = Jugador::where('activo', true)->get();

        $rankings = $jugadores->map(function ($j) {
            return array_merge(['jugador' => $j], calcularEstadisticasTemporada($j->id));
        });

        $goleadores   = $rankings->sortByDesc('goles')->take(10)->values();
        $asistentes   = $rankings->sortByDesc('asistencias')->take(10)->values();
        $amonestados  = $rankings->sortByDesc('amarillas')->take(10)->values();
        $porteros     = $rankings->where('jugador.posicion', 'Portero')
                                 ->sortByDesc('porterias_a_cero')->values();

        return view('estadisticas.index', compact('goleadores', 'asistentes', 'amonestados', 'porteros'));
    }

    public function comparar()
    {
        $jugadores = Jugador::where('activo', true)->orderBy('nombre')->get();
        $statsA = $statsB = null;
        $jugadorA = $jugadorB = null;

        if (request()->filled('jugador_a') && request()->filled('jugador_b')) {
            $jugadorA = Jugador::find(request('jugador_a'));
            $jugadorB = Jugador::find(request('jugador_b'));
            $statsA   = calcularEstadisticasTemporada($jugadorA->id);
            $statsB   = calcularEstadisticasTemporada($jugadorB->id);
        }

        return view('estadisticas.comparar', compact('jugadores', 'jugadorA', 'jugadorB', 'statsA', 'statsB'));
    }
}