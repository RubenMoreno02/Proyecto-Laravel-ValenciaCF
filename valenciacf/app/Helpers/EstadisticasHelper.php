<?php

use App\Models\EstadisticaPartido;

if (!function_exists('calcularEstadisticasTemporada')) {
    function calcularEstadisticasTemporada(int $jugadorId, ?string $competicion = null): array
    {
        $query = EstadisticaPartido::where('jugador_id', $jugadorId)
            ->where('minutos_jugados', '>', 0)
            ->with('partido');

        if ($competicion) {
            $query->whereHas('partido', function ($q) use ($competicion) {
                $q->where('competicion', $competicion);
            });
        }

        $stats = $query->get();

        $partidosJugados   = $stats->count();
        $minutosTotales    = $stats->sum('minutos_jugados');
        $goles             = $stats->sum('goles');
        $asistencias       = $stats->sum('asistencias');
        $amarillas         = $stats->sum('amarillas');
        $rojas             = $stats->sum('rojas');
        $faltasCometidas   = $stats->sum('faltas_cometidas');
        $faltasRecibidas   = $stats->sum('faltas_recibidas');
        $porteriasACero    = $stats->where('portero_imbatido', true)->count();
        $ratioGoles        = $partidosJugados > 0
                             ? round($goles / $partidosJugados, 2)
                             : 0;

        return [
            'partidos_jugados'      => $partidosJugados,
            'minutos_totales'       => $minutosTotales,
            'goles'                 => $goles,
            'asistencias'           => $asistencias,
            'amarillas'             => $amarillas,
            'rojas'                 => $rojas,
            'faltas_cometidas'      => $faltasCometidas,
            'faltas_recibidas'      => $faltasRecibidas,
            'porterias_a_cero'      => $porteriasACero,
            'ratio_goles_por_partido' => $ratioGoles,
        ];
    }
}