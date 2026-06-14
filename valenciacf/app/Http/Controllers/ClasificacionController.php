<?php
namespace App\Http\Controllers;

use App\Models\Partido;

class ClasificacionController extends Controller
{
    public function index()
    {
        $partidos = Partido::where('competicion', 'Liga')
            ->orderBy('jornada')
            ->get();

        $puntos = 0; $pj = 0; $pg = 0; $pe = 0; $pp = 0;
        $gf = 0; $gc = 0;
        $evolucion = [];

        foreach ($partidos as $p) {
            $pj++;
            $gf += $p->goles_favor;
            $gc += $p->goles_contra;
            if ($p->goles_favor > $p->goles_contra) {
                $pg++; $puntos += 3;
                $evolucion[] = ['jornada' => $p->jornada, 'puntos' => $puntos,
                                'resultado' => 'V', 'rival' => $p->rival,
                                'marcador' => $p->goles_favor.'-'.$p->goles_contra];
            } elseif ($p->goles_favor === $p->goles_contra) {
                $pe++; $puntos += 1;
                $evolucion[] = ['jornada' => $p->jornada, 'puntos' => $puntos,
                                'resultado' => 'E', 'rival' => $p->rival,
                                'marcador' => $p->goles_favor.'-'.$p->goles_contra];
            } else {
                $pp++;
                $evolucion[] = ['jornada' => $p->jornada, 'puntos' => $puntos,
                                'resultado' => 'D', 'rival' => $p->rival,
                                'marcador' => $p->goles_favor.'-'.$p->goles_contra];
            }
        }

        // Asistencia en Mestalla (partidos locales)
        $locales = $partidos->where('sede', 'Local');
        $capacidadMestalla = 49430;
        $asistencias = $locales->map(function ($p) use ($capacidadMestalla) {
            // Simulamos la asistencia basada en el rival (dato aproximado)
            $aforo = match(true) {
                str_contains($p->rival, 'Madrid') || str_contains($p->rival, 'Barcelona') => rand(47000, 49430),
                str_contains($p->rival, 'Atlético') || str_contains($p->rival, 'Villarreal') => rand(40000, 46000),
                default => rand(28000, 38000),
            };
            return [
                'rival'      => $p->rival,
                'jornada'    => $p->jornada,
                'aforo'      => $aforo,
                'porcentaje' => round(($aforo / $capacidadMestalla) * 100, 1),
                'marcador'   => $p->goles_favor.'-'.$p->goles_contra,
            ];
        })->values();

        return view('clasificacion.index', compact(
            'puntos','pj','pg','pe','pp','gf','gc','evolucion','asistencias','capacidadMestalla'
        ));
    }
}