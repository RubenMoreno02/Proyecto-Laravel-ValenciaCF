<?php
namespace Database\Seeders;

use App\Models\Partido;
use Illuminate\Database\Seeder;

class PartidoSeeder extends Seeder
{
    public function run(): void
    {
        $partidos = [
            ['rival'=>'RCD Mallorca',         'fecha'=>'2025-08-16','competicion'=>'Liga','jornada'=>1, 'sede'=>'Local',    'goles_favor'=>1,'goles_contra'=>0,'estadio'=>'Mestalla'],
            ['rival'=>'Real Betis',            'fecha'=>'2025-08-24','competicion'=>'Liga','jornada'=>2, 'sede'=>'Visitante','goles_favor'=>1,'goles_contra'=>2,'estadio'=>'Benito Villamarín'],
            ['rival'=>'Deportivo Alavés',      'fecha'=>'2025-08-31','competicion'=>'Liga','jornada'=>3, 'sede'=>'Local',    'goles_favor'=>2,'goles_contra'=>0,'estadio'=>'Mestalla'],
            ['rival'=>'Girona FC',             'fecha'=>'2025-09-14','competicion'=>'Liga','jornada'=>4, 'sede'=>'Visitante','goles_favor'=>0,'goles_contra'=>1,'estadio'=>'Montilivi'],
            ['rival'=>'CD Leganés',            'fecha'=>'2025-09-21','competicion'=>'Liga','jornada'=>5, 'sede'=>'Local',    'goles_favor'=>3,'goles_contra'=>1,'estadio'=>'Mestalla'],
            ['rival'=>'Rayo Vallecano',        'fecha'=>'2025-09-28','competicion'=>'Liga','jornada'=>6, 'sede'=>'Visitante','goles_favor'=>1,'goles_contra'=>1,'estadio'=>'Estadio de Vallecas'],
            ['rival'=>'RCD Espanyol',          'fecha'=>'2025-10-05','competicion'=>'Liga','jornada'=>7, 'sede'=>'Local',    'goles_favor'=>2,'goles_contra'=>1,'estadio'=>'Mestalla'],
            ['rival'=>'Athletic Club',         'fecha'=>'2025-10-19','competicion'=>'Liga','jornada'=>8, 'sede'=>'Visitante','goles_favor'=>0,'goles_contra'=>2,'estadio'=>'San Mamés'],
            ['rival'=>'Real Madrid',           'fecha'=>'2025-10-26','competicion'=>'Liga','jornada'=>9, 'sede'=>'Local',    'goles_favor'=>2,'goles_contra'=>2,'estadio'=>'Mestalla'],
            ['rival'=>'Getafe CF',             'fecha'=>'2025-11-02','competicion'=>'Liga','jornada'=>10,'sede'=>'Visitante','goles_favor'=>1,'goles_contra'=>0,'estadio'=>'Coliseum Alfonso Pérez'],
            ['rival'=>'Real Sociedad',         'fecha'=>'2025-11-09','competicion'=>'Liga','jornada'=>11,'sede'=>'Local',    'goles_favor'=>1,'goles_contra'=>1,'estadio'=>'Mestalla'],
            ['rival'=>'Sevilla FC',            'fecha'=>'2025-11-23','competicion'=>'Liga','jornada'=>12,'sede'=>'Visitante','goles_favor'=>0,'goles_contra'=>2,'estadio'=>'Ramón Sánchez-Pizjuán'],
            ['rival'=>'Villarreal CF',         'fecha'=>'2025-11-30','competicion'=>'Liga','jornada'=>13,'sede'=>'Local',    'goles_favor'=>3,'goles_contra'=>0,'estadio'=>'Mestalla'],
            ['rival'=>'Atlético de Madrid',    'fecha'=>'2025-12-07','competicion'=>'Liga','jornada'=>14,'sede'=>'Visitante','goles_favor'=>0,'goles_contra'=>1,'estadio'=>'Metropolitano'],
            ['rival'=>'FC Barcelona',          'fecha'=>'2025-12-14','competicion'=>'Liga','jornada'=>15,'sede'=>'Local',    'goles_favor'=>1,'goles_contra'=>2,'estadio'=>'Mestalla'],
            ['rival'=>'Celta de Vigo',         'fecha'=>'2025-12-21','competicion'=>'Liga','jornada'=>16,'sede'=>'Visitante','goles_favor'=>2,'goles_contra'=>1,'estadio'=>'Abanca Balaídos'],
            ['rival'=>'UD Las Palmas',         'fecha'=>'2026-01-04','competicion'=>'Liga','jornada'=>17,'sede'=>'Local',    'goles_favor'=>3,'goles_contra'=>0,'estadio'=>'Mestalla'],
            ['rival'=>'Real Valladolid',       'fecha'=>'2026-01-11','competicion'=>'Liga','jornada'=>18,'sede'=>'Visitante','goles_favor'=>2,'goles_contra'=>0,'estadio'=>'José Zorrilla'],
            ['rival'=>'RCD Mallorca',          'fecha'=>'2026-01-18','competicion'=>'Copa del Rey','jornada'=>null,'sede'=>'Local','goles_favor'=>3,'goles_contra'=>1,'estadio'=>'Mestalla'],
            ['rival'=>'CA Osasuna',            'fecha'=>'2026-01-25','competicion'=>'Liga','jornada'=>19,'sede'=>'Local',    'goles_favor'=>1,'goles_contra'=>0,'estadio'=>'Mestalla'],
            ['rival'=>'Atlético de Madrid',    'fecha'=>'2026-02-01','competicion'=>'Copa del Rey','jornada'=>null,'sede'=>'Visitante','goles_favor'=>1,'goles_contra'=>1,'estadio'=>'Metropolitano'],
            ['rival'=>'RCD Mallorca',          'fecha'=>'2026-02-08','competicion'=>'Liga','jornada'=>20,'sede'=>'Visitante','goles_favor'=>1,'goles_contra'=>1,'estadio'=>'Visit Mallorca Estadi'],
            ['rival'=>'Real Betis',            'fecha'=>'2026-02-15','competicion'=>'Liga','jornada'=>21,'sede'=>'Local',    'goles_favor'=>2,'goles_contra'=>0,'estadio'=>'Mestalla'],
            ['rival'=>'Deportivo Alavés',      'fecha'=>'2026-02-22','competicion'=>'Liga','jornada'=>22,'sede'=>'Visitante','goles_favor'=>1,'goles_contra'=>0,'estadio'=>'Mendizorrotza'],
            ['rival'=>'Girona FC',             'fecha'=>'2026-03-01','competicion'=>'Liga','jornada'=>23,'sede'=>'Local',    'goles_favor'=>2,'goles_contra'=>1,'estadio'=>'Mestalla'],
            ['rival'=>'CD Leganés',            'fecha'=>'2026-03-08','competicion'=>'Liga','jornada'=>24,'sede'=>'Visitante','goles_favor'=>0,'goles_contra'=>0,'estadio'=>'Butarque'],
            ['rival'=>'Rayo Vallecano',        'fecha'=>'2026-03-15','competicion'=>'Liga','jornada'=>25,'sede'=>'Local',    'goles_favor'=>3,'goles_contra'=>1,'estadio'=>'Mestalla'],
            ['rival'=>'RCD Espanyol',          'fecha'=>'2026-03-22','competicion'=>'Liga','jornada'=>26,'sede'=>'Visitante','goles_favor'=>1,'goles_contra'=>1,'estadio'=>'RCDE Stadium'],
            ['rival'=>'Athletic Club',         'fecha'=>'2026-04-05','competicion'=>'Liga','jornada'=>27,'sede'=>'Local',    'goles_favor'=>2,'goles_contra'=>0,'estadio'=>'Mestalla'],
            ['rival'=>'Real Madrid',           'fecha'=>'2026-04-12','competicion'=>'Liga','jornada'=>28,'sede'=>'Visitante','goles_favor'=>0,'goles_contra'=>3,'estadio'=>'Santiago Bernabéu'],
        ];

        foreach ($partidos as $p) {
            Partido::create($p);
        }
    }
}