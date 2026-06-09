<?php
namespace Database\Seeders;

use App\Models\EstadisticaPartido;
use App\Models\Partido;
use App\Models\Jugador;
use Illuminate\Database\Seeder;

class EstadisticaSeeder extends Seeder
{
    public function run(): void
    {
        $partidos = Partido::all();
        $jugadores = Jugador::where('activo', true)->get();

        if ($jugadores->isEmpty() || $partidos->isEmpty()) {
            $this->command->warn('No hay jugadores o partidos. Ejecuta antes JugadorSeeder y PartidoSeeder.');
            return;
        }

        // Estadísticas definidas manualmente para los primeros partidos
        // Formato: [partido_index, jugador_dorsal, min, goles, asist, amar, rojas, f_com, f_rec, portero_imbatido, titular]
        $datos = [
            // Partido 1: VCF 2-1 Real Madrid
            [0, 1,  90, 0, 0, 0, 0, 0, 0, true,  true],
            [0, 2,  90, 0, 1, 0, 0, 1, 2, false, true],
            [0, 5,  90, 0, 0, 0, 0, 2, 1, false, true],
            [0, 14, 90, 0, 0, 1, 0, 1, 3, false, true],
            [0, 18, 90, 0, 0, 0, 0, 1, 1, false, true],
            [0, 8,  90, 1, 0, 1, 0, 2, 1, false, true],
            [0, 6,  85, 0, 1, 0, 0, 1, 2, false, true],
            [0, 16, 70, 0, 0, 0, 0, 1, 1, false, true],
            [0, 9,  90, 1, 0, 0, 0, 2, 3, false, true],
            [0, 11, 80, 0, 0, 0, 0, 1, 2, false, true],

            // Partido 2: VCF 1-1 FC Barcelona
            [1, 1,  90, 0, 0, 0, 0, 0, 0, false, true],
            [1, 2,  90, 0, 0, 1, 0, 2, 1, false, true],
            [1, 5,  90, 0, 0, 0, 0, 1, 0, false, true],
            [1, 14, 90, 0, 0, 0, 0, 0, 2, false, true],
            [1, 18, 90, 0, 0, 1, 0, 3, 1, false, true],
            [1, 8,  90, 0, 1, 0, 0, 2, 3, false, true],
            [1, 6,  90, 0, 0, 0, 0, 1, 1, false, true],
            [1, 16, 60, 0, 0, 0, 0, 0, 0, false, true],
            [1, 9,  90, 1, 0, 0, 0, 1, 4, false, true],
            [1, 11, 90, 0, 0, 0, 0, 2, 1, false, true],

            // Partido 3: VCF 3-0 Atlético de Madrid
            [2, 1,  90, 0, 0, 0, 0, 0, 0, true,  true],
            [2, 2,  90, 0, 0, 0, 0, 1, 1, false, true],
            [2, 5,  90, 0, 0, 0, 0, 2, 0, false, true],
            [2, 14, 90, 1, 0, 0, 0, 0, 2, false, true],
            [2, 18, 90, 0, 0, 0, 0, 1, 1, false, true],
            [2, 8,  90, 1, 1, 0, 0, 2, 2, false, true],
            [2, 6,  90, 0, 1, 0, 0, 1, 1, false, true],
            [2, 16, 90, 0, 0, 0, 0, 1, 0, false, true],
            [2, 9,  90, 1, 0, 0, 0, 2, 3, false, true],
            [2, 11, 75, 0, 1, 0, 0, 1, 2, false, true],

            // Partido 4: VCF 0-2 Sevilla
            [3, 1,  90, 0, 0, 0, 0, 0, 0, false, true],
            [3, 2,  90, 0, 0, 1, 0, 3, 1, false, true],
            [3, 5,  90, 0, 0, 0, 0, 2, 1, false, true],
            [3, 14, 90, 0, 0, 0, 0, 1, 1, false, true],
            [3, 18, 90, 0, 0, 0, 1, 2, 0, false, true],
            [3, 8,  90, 0, 0, 1, 0, 3, 2, false, true],
            [3, 6,  90, 0, 0, 0, 0, 2, 1, false, true],
            [3, 16, 70, 0, 0, 0, 0, 1, 0, false, true],
            [3, 9,  80, 0, 0, 0, 0, 1, 2, false, true],
            [3, 11, 90, 0, 0, 0, 0, 2, 3, false, true],

            // Partido 5: VCF 2-2 Villarreal
            [4, 1,  90, 0, 0, 0, 0, 0, 0, false, true],
            [4, 2,  90, 0, 1, 0, 0, 1, 2, false, true],
            [4, 5,  90, 0, 0, 1, 0, 2, 1, false, true],
            [4, 14, 90, 0, 0, 0, 0, 1, 3, false, true],
            [4, 18, 90, 0, 0, 0, 0, 2, 0, false, true],
            [4, 8,  90, 1, 0, 0, 0, 2, 2, false, true],
            [4, 6,  90, 0, 1, 1, 0, 1, 1, false, true],
            [4, 16, 90, 0, 0, 0, 0, 2, 1, false, true],
            [4, 9,  90, 1, 0, 0, 0, 1, 3, false, true],
            [4, 11, 80, 0, 0, 0, 0, 1, 2, false, true],

            // Partido 6: Copa del Rey VCF 4-1 Las Palmas
            [5, 1,  90, 0, 0, 0, 0, 0, 0, false, true],
            [5, 5,  90, 1, 0, 0, 0, 1, 1, false, true],
            [5, 14, 90, 0, 1, 0, 0, 0, 2, false, true],
            [5, 8,  90, 1, 1, 0, 0, 1, 1, false, true],
            [5, 16, 80, 0, 1, 0, 0, 2, 0, false, true],
            [5, 9,  90, 2, 0, 0, 0, 1, 4, false, true],
            [5, 11, 90, 0, 1, 0, 0, 1, 2, false, true],

            // Partido 7: VCF 1-0 Athletic Club
            [6, 1,  90, 0, 0, 0, 0, 0, 0, true,  true],
            [6, 2,  90, 0, 0, 0, 0, 2, 1, false, true],
            [6, 5,  90, 0, 0, 0, 0, 1, 0, false, true],
            [6, 14, 90, 0, 1, 0, 0, 0, 3, false, true],
            [6, 18, 90, 0, 0, 1, 0, 2, 1, false, true],
            [6, 8,  90, 0, 0, 0, 0, 2, 2, false, true],
            [6, 6,  90, 0, 0, 0, 0, 1, 1, false, true],
            [6, 16, 90, 1, 0, 0, 0, 1, 1, false, true],
            [6, 9,  75, 0, 0, 0, 0, 2, 3, false, true],
            [6, 11, 90, 0, 0, 0, 0, 1, 1, false, true],

            // Partido 8: VCF 3-1 Rayo Vallecano
            [7, 1,  90, 0, 0, 0, 0, 0, 0, false, true],
            [7, 2,  90, 0, 1, 0, 0, 1, 2, false, true],
            [7, 5,  90, 0, 0, 0, 0, 1, 0, false, true],
            [7, 14, 90, 1, 0, 0, 0, 0, 2, false, true],
            [7, 18, 90, 0, 0, 0, 0, 1, 1, false, true],
            [7, 8,  90, 1, 1, 1, 0, 2, 2, false, true],
            [7, 6,  90, 0, 1, 0, 0, 1, 1, false, true],
            [7, 16, 90, 0, 0, 0, 0, 1, 1, false, true],
            [7, 9,  90, 1, 0, 0, 0, 2, 3, false, true],
            [7, 11, 80, 0, 0, 0, 0, 1, 2, false, true],
        ];

        foreach ($datos as $fila) {
            [$pIdx, $dorsal, $min, $goles, $asist, $amar, $rojas,
             $fCom, $fRec, $portImbatido, $titular] = $fila;

            $partido = $partidos->get($pIdx);
            $jugador = $jugadores->firstWhere('dorsal', $dorsal);

            if (!$partido || !$jugador) continue;

            EstadisticaPartido::create([
                'partido_id'       => $partido->id,
                'jugador_id'       => $jugador->id,
                'minutos_jugados'  => $min,
                'goles'            => $goles,
                'asistencias'      => $asist,
                'amarillas'        => $amar,
                'rojas'            => $rojas,
                'faltas_cometidas' => $fCom,
                'faltas_recibidas' => $fRec,
                'portero_imbatido' => $portImbatido,
                'titular'          => $titular,
            ]);
        }

        $this->command->info('Estadísticas creadas correctamente.');
    }
}