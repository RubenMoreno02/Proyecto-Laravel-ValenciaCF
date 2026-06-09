<?php
namespace Database\Seeders;

use App\Models\Partido;
use Illuminate\Database\Seeder;

class PartidoSeeder extends Seeder
{
    public function run(): void
    {
        $partidos = [
            [
                'rival' => 'Real Madrid',
                'fecha' => '2025-08-18',
                'competicion' => 'Liga',
                'jornada' => 1,
                'sede' => 'Local',
                'goles_favor' => 2,
                'goles_contra' => 1,
                'estadio' => 'Mestalla',
            ],
            [
                'rival' => 'FC Barcelona',
                'fecha' => '2025-08-25',
                'competicion' => 'Liga',
                'jornada' => 2,
                'sede' => 'Visitante',
                'goles_favor' => 1,
                'goles_contra' => 1,
                'estadio' => 'Spotify Camp Nou',
            ],
            [
                'rival' => 'Atlético de Madrid',
                'fecha' => '2025-09-01',
                'competicion' => 'Liga',
                'jornada' => 3,
                'sede' => 'Local',
                'goles_favor' => 3,
                'goles_contra' => 0,
                'estadio' => 'Mestalla',
            ],
            [
                'rival' => 'Sevilla FC',
                'fecha' => '2025-09-15',
                'competicion' => 'Liga',
                'jornada' => 4,
                'sede' => 'Visitante',
                'goles_favor' => 0,
                'goles_contra' => 2,
                'estadio' => 'Ramón Sánchez-Pizjuán',
            ],
            [
                'rival' => 'Villarreal CF',
                'fecha' => '2025-09-22',
                'competicion' => 'Liga',
                'jornada' => 5,
                'sede' => 'Local',
                'goles_favor' => 2,
                'goles_contra' => 2,
                'estadio' => 'Mestalla',
            ],
            [
                'rival' => 'UD Las Palmas',
                'fecha' => '2025-10-05',
                'competicion' => 'Copa del Rey',
                'jornada' => null,
                'sede' => 'Local',
                'goles_favor' => 4,
                'goles_contra' => 1,
                'estadio' => 'Mestalla',
            ],
            [
                'rival' => 'Athletic Club',
                'fecha' => '2025-10-19',
                'competicion' => 'Liga',
                'jornada' => 6,
                'sede' => 'Visitante',
                'goles_favor' => 1,
                'goles_contra' => 0,
                'estadio' => 'San Mamés',
            ],
            [
                'rival' => 'Rayo Vallecano',
                'fecha' => '2025-11-02',
                'competicion' => 'Liga',
                'jornada' => 7,
                'sede' => 'Local',
                'goles_favor' => 3,
                'goles_contra' => 1,
                'estadio' => 'Mestalla',
            ],
        ];

        foreach ($partidos as $p) {
            Partido::create($p);
        }
    }
}