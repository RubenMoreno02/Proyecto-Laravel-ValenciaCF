<?php
namespace Database\Seeders;

use App\Models\Jugador;
use Illuminate\Database\Seeder;

class JugadorSeeder extends Seeder
{
    public function run(): void
    {
        $jugadores = [
            ['nombre' => 'Giorgi Mamardashvili', 'dorsal' => 1,  'posicion' => 'Portero',   'nacionalidad' => 'Georgia',   'fecha_nacimiento' => '2000-09-29', 'fecha_incorporacion' => '2020-07-01'],
            ['nombre' => 'Thierry Correia',      'dorsal' => 2,  'posicion' => 'Defensa',   'nacionalidad' => 'Portugal',  'fecha_nacimiento' => '1999-03-09', 'fecha_incorporacion' => '2019-08-01'],
            ['nombre' => 'Cristhian Mosquera',   'dorsal' => 5,  'posicion' => 'Defensa',   'nacionalidad' => 'España',    'fecha_nacimiento' => '2004-03-26', 'fecha_incorporacion' => '2022-07-01'],
            ['nombre' => 'José Gayà',            'dorsal' => 14, 'posicion' => 'Defensa',   'nacionalidad' => 'España',    'fecha_nacimiento' => '1995-05-25', 'fecha_incorporacion' => '2012-07-01'],
            ['nombre' => 'Diego López',          'dorsal' => 18, 'posicion' => 'Defensa',   'nacionalidad' => 'España',    'fecha_nacimiento' => '1992-09-22', 'fecha_incorporacion' => '2021-07-01'],
            ['nombre' => 'Pepelu',               'dorsal' => 8,  'posicion' => 'Medio',     'nacionalidad' => 'España',    'fecha_nacimiento' => '1999-09-11', 'fecha_incorporacion' => '2022-07-01'],
            ['nombre' => 'André Almeida',        'dorsal' => 6,  'posicion' => 'Medio',     'nacionalidad' => 'Portugal',  'fecha_nacimiento' => '1990-09-30', 'fecha_incorporacion' => '2023-07-01'],
            ['nombre' => 'Javi Guerra',          'dorsal' => 16, 'posicion' => 'Medio',     'nacionalidad' => 'España',    'fecha_nacimiento' => '2002-03-22', 'fecha_incorporacion' => '2023-07-01'],
            ['nombre' => 'Rafa Mir',             'dorsal' => 9,  'posicion' => 'Delantero', 'nacionalidad' => 'España',    'fecha_nacimiento' => '1997-06-18', 'fecha_incorporacion' => '2022-07-01'],
            ['nombre' => 'Hugo Duro',            'dorsal' => 11, 'posicion' => 'Delantero', 'nacionalidad' => 'España',    'fecha_nacimiento' => '1999-11-10', 'fecha_incorporacion' => '2021-07-01'],
        ];

        foreach ($jugadores as $j) {
            Jugador::create(array_merge($j, ['activo' => true]));
        }
    }
}