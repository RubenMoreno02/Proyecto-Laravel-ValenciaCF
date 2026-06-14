<?php
namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Partido;
use App\Models\Titulo;
use App\Models\EstadisticaPartido;

class HistoriaController extends Controller
{
    public function index()
    {
        $titulos = Titulo::orderBy('anio', 'desc')->get();

        // Top goleadores históricos (temporada actual)
        $jugadores = Jugador::where('activo', true)->get();
        $topGoleadores = $jugadores->map(function ($j) {
            $stats = calcularEstadisticasTemporada($j->id);
            return ['jugador' => $j, 'stats' => $stats];
        })->sortByDesc('stats.goles')->take(10)->values();

        $topAsistentes = $jugadores->map(function ($j) {
            $stats = calcularEstadisticasTemporada($j->id);
            return ['jugador' => $j, 'stats' => $stats];
        })->sortByDesc('stats.asistencias')->take(10)->values();

        $topPartidos = $jugadores->map(function ($j) {
            $stats = calcularEstadisticasTemporada($j->id);
            return ['jugador' => $j, 'stats' => $stats];
        })->sortByDesc('stats.partidos_jugados')->take(10)->values();

        // MVPs de la temporada
        $mvps = EstadisticaPartido::where('mvp', true)
            ->with(['jugador', 'partido'])
            ->get()
            ->groupBy('jugador_id')
            ->map(function ($items) {
                return [
                    'jugador' => $items->first()->jugador,
                    'total'   => $items->count(),
                ];
            })
            ->sortByDesc('total')
            ->take(5)
            ->values();

        return view('historia.index', compact(
            'titulos', 'topGoleadores', 'topAsistentes', 'topPartidos', 'mvps'
        ));
    }
}