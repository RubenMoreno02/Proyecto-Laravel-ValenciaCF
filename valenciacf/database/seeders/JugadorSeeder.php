<?php
namespace Database\Seeders;

use App\Models\Jugador;
use Illuminate\Database\Seeder;

class JugadorSeeder extends Seeder
{
    public function run(): void
    {
        $jugadores = [
            // PORTEROS
            ['nombre' => 'Giorgi Mamardashvili', 'dorsal' => 25, 'posicion' => 'Portero',   'nacionalidad' => 'Georgia',      'fecha_nacimiento' => '2000-09-29', 'fecha_incorporacion' => '2020-07-01', 'altura_cm' => 198, 'peso_kg' => 87.0],
            ['nombre' => 'Jaume Domènech',       'dorsal' => 13, 'posicion' => 'Portero',   'nacionalidad' => 'España',       'fecha_nacimiento' => '1990-11-05', 'fecha_incorporacion' => '2016-07-01', 'altura_cm' => 186, 'peso_kg' => 80.0],

            // DEFENSAS
            ['nombre' => 'Thierry Correia',      'dorsal' => 2,  'posicion' => 'Defensa',   'nacionalidad' => 'Portugal',     'fecha_nacimiento' => '1999-03-09', 'fecha_incorporacion' => '2019-08-01', 'altura_cm' => 178, 'peso_kg' => 71.0],
            ['nombre' => 'Cenk Özkacar',         'dorsal' => 4,  'posicion' => 'Defensa',   'nacionalidad' => 'Turquía',      'fecha_nacimiento' => '2000-10-22', 'fecha_incorporacion' => '2021-07-01', 'altura_cm' => 186, 'peso_kg' => 79.0],
            ['nombre' => 'Cristhian Mosquera',   'dorsal' => 5,  'posicion' => 'Defensa',   'nacionalidad' => 'España',       'fecha_nacimiento' => '2004-03-26', 'fecha_incorporacion' => '2022-07-01', 'altura_cm' => 185, 'peso_kg' => 78.0],
            ['nombre' => 'César Tárrega',        'dorsal' => 3,  'posicion' => 'Defensa',   'nacionalidad' => 'España',       'fecha_nacimiento' => '2003-11-14', 'fecha_incorporacion' => '2023-07-01', 'altura_cm' => 187, 'peso_kg' => 80.0],
            ['nombre' => 'José Gayà',            'dorsal' => 14, 'posicion' => 'Defensa',   'nacionalidad' => 'España',       'fecha_nacimiento' => '1995-05-25', 'fecha_incorporacion' => '2012-07-01', 'altura_cm' => 172, 'peso_kg' => 68.0],
            ['nombre' => 'Jesús Vázquez',        'dorsal' => 15, 'posicion' => 'Defensa',   'nacionalidad' => 'España',       'fecha_nacimiento' => '2002-10-11', 'fecha_incorporacion' => '2021-07-01', 'altura_cm' => 178, 'peso_kg' => 70.0],
            ['nombre' => 'Dimitri Foulquier',    'dorsal' => 21, 'posicion' => 'Defensa',   'nacionalidad' => 'Francia',      'fecha_nacimiento' => '1992-06-23', 'fecha_incorporacion' => '2022-07-01', 'altura_cm' => 175, 'peso_kg' => 72.0],

            // CENTROCAMPISTAS
            ['nombre' => 'Pepelu',               'dorsal' => 8,  'posicion' => 'Medio',     'nacionalidad' => 'España',       'fecha_nacimiento' => '1999-09-11', 'fecha_incorporacion' => '2022-07-01', 'altura_cm' => 183, 'peso_kg' => 77.0],
            ['nombre' => 'André Almeida',        'dorsal' => 6,  'posicion' => 'Medio',     'nacionalidad' => 'Portugal',     'fecha_nacimiento' => '1990-09-30', 'fecha_incorporacion' => '2023-07-01', 'altura_cm' => 180, 'peso_kg' => 75.0],
            ['nombre' => 'Javi Guerra',          'dorsal' => 16, 'posicion' => 'Medio',     'nacionalidad' => 'España',       'fecha_nacimiento' => '2002-03-22', 'fecha_incorporacion' => '2023-07-01', 'altura_cm' => 179, 'peso_kg' => 73.0],
            ['nombre' => 'Guillamón',            'dorsal' => 18, 'posicion' => 'Medio',     'nacionalidad' => 'España',       'fecha_nacimiento' => '2001-01-25', 'fecha_incorporacion' => '2019-07-01', 'altura_cm' => 177, 'peso_kg' => 70.0],
            ['nombre' => 'Sergi Canós',          'dorsal' => 11, 'posicion' => 'Medio',     'nacionalidad' => 'España',       'fecha_nacimiento' => '1997-02-02', 'fecha_incorporacion' => '2023-07-01', 'altura_cm' => 172, 'peso_kg' => 69.0],
            ['nombre' => 'Fran Pérez',           'dorsal' => 17, 'posicion' => 'Medio',     'nacionalidad' => 'España',       'fecha_nacimiento' => '2003-08-15', 'fecha_incorporacion' => '2023-07-01', 'altura_cm' => 175, 'peso_kg' => 68.0],

            // DELANTEROS
            ['nombre' => 'Hugo Duro',            'dorsal' => 9,  'posicion' => 'Delantero', 'nacionalidad' => 'España',       'fecha_nacimiento' => '1999-11-10', 'fecha_incorporacion' => '2021-07-01', 'altura_cm' => 183, 'peso_kg' => 78.0],
            ['nombre' => 'Dani Gómez',           'dorsal' => 7,  'posicion' => 'Delantero', 'nacionalidad' => 'España',       'fecha_nacimiento' => '1998-08-06', 'fecha_incorporacion' => '2023-07-01', 'altura_cm' => 177, 'peso_kg' => 73.0],
            ['nombre' => 'Diego López',          'dorsal' => 19, 'posicion' => 'Delantero', 'nacionalidad' => 'España',       'fecha_nacimiento' => '1992-09-22', 'fecha_incorporacion' => '2021-07-01', 'altura_cm' => 180, 'peso_kg' => 77.0],
            ['nombre' => 'Rafa Mir',             'dorsal' => 10, 'posicion' => 'Delantero', 'nacionalidad' => 'España',       'fecha_nacimiento' => '1997-06-18', 'fecha_incorporacion' => '2022-07-01', 'altura_cm' => 190, 'peso_kg' => 84.0],
            ['nombre' => 'Kluivert',             'dorsal' => 22, 'posicion' => 'Delantero', 'nacionalidad' => 'Países Bajos', 'fecha_nacimiento' => '1999-05-05', 'fecha_incorporacion' => '2023-07-01', 'altura_cm' => 182, 'peso_kg' => 76.0],
        ];

        foreach ($jugadores as $j) {
            Jugador::create(array_merge($j, ['activo' => true]));
        }
    }
}