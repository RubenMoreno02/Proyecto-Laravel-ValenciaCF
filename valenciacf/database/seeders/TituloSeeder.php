<?php
namespace Database\Seeders;

use App\Models\Titulo;
use Illuminate\Database\Seeder;

class TituloSeeder extends Seeder
{
    public function run(): void
    {
        $titulos = [
            // LIGA
            ['competicion' => 'Liga Española', 'anio' => 2004, 'entrenador' => 'Rafael Benítez',
             'descripcion' => 'Segunda Liga del Valencia CF. Con Rafa Benítez como entrenador y una plantilla legendaria con Albelda, Ayala, Baraja, Vicente y Mista. El equipo terminó invicto en Mestalla.'],
            ['competicion' => 'Liga Española', 'anio' => 2002, 'entrenador' => 'Rafael Benítez',
             'descripcion' => 'Primera Liga de la era moderna del Valencia CF. Benítez consiguió el título en una temporada histórica con 75 puntos.'],
            ['competicion' => 'Liga Española', 'anio' => 1971, 'entrenador' => 'Alfredo Di Stéfano',
             'descripcion' => 'Primera Liga de la historia del Valencia CF, dirigidos por la leyenda Alfredo Di Stéfano como entrenador.'],
            ['competicion' => 'Liga Española', 'anio' => 1947, 'entrenador' => 'Ramón Encinas',
             'descripcion' => 'Temporada histórica del Valencia CF. Título conquistado con una generación dorada de jugadores valencianos.'],
            ['competicion' => 'Liga Española', 'anio' => 1944, 'entrenador' => 'Ramón Encinas',
             'descripcion' => 'Segundo título de Liga del Valencia CF en la época dorada de los años 40.'],
            ['competicion' => 'Liga Española', 'anio' => 1942, 'entrenador' => 'Ramón Encinas',
             'descripcion' => 'Primera Liga de la época dorada. Inicio de una racha histórica del club valenciano.'],

            // COPA DEL REY
            ['competicion' => 'Copa del Rey', 'anio' => 2019, 'entrenador' => 'Marcelino Torán',
             'descripcion' => 'Final ante el FC BArcelona (2-1). Goles de Gamerio y Rodrigo Moreno. Una de las finales más recordadas al ser el año del centenario del club.'],
            ['competicion' => 'Copa del Rey', 'anio' => 2008, 'entrenador' => 'Ronald Koeman',
             'descripcion' => 'Final ante el Getafe CF (3-1). Goles de Villa, Mata y Silva. Una de las finales más recordadas de la historia reciente del club.'],
            ['competicion' => 'Copa del Rey', 'anio' => 1999, 'entrenador' => 'Claudio Ranieri',
             'descripcion' => 'Final ante el Atlético de Madrid. Título que impulsó al club hacia el éxito europeo de los años siguientes.'],
            ['competicion' => 'Copa del Rey', 'anio' => 1979, 'entrenador' => 'Luis Molowny',
             'descripcion' => 'Copa del Rey ganada ante el Real Madrid. Un hito histórico en la era moderna del club.'],
            ['competicion' => 'Copa del Rey', 'anio' => 1967, 'entrenador' => 'Alejandro Scopelli',
             'descripcion' => 'Copa ganada bajo la dirección técnica de Scopelli, en una época de gran éxito europeo para el club.'],
            ['competicion' => 'Copa del Rey', 'anio' => 1954, 'entrenador' => 'Ramón Encinas',
             'descripcion' => 'Copa del Rey conquistada en la continuación de la era dorada del Valencia CF.'],
            ['competicion' => 'Copa del Rey', 'anio' => 1949, 'entrenador' => 'Ramón Encinas',
             'descripcion' => 'Final ganada en el Estadio Montjuïc de Barcelona ante el Sevilla FC.'],
            ['competicion' => 'Copa del Rey', 'anio' => 1941, 'entrenador' => 'Ramón Encinas',
             'descripcion' => 'Primera Copa del Rey del Valencia CF. Inicio de la época dorada del club.'],

            // UEFA / EUROPA LEAGUE
            ['competicion' => 'UEFA', 'anio' => 2004, 'entrenador' => 'Rafael Benítez',
             'descripcion' => 'Final en Göteborg ante el Olympique de Marsella (2-0). Goles de Mista y Vicente. Doblete histórico Liga + UEFA.'],
            ['competicion' => 'UEFA', 'anio' => 1980, 'entrenador' => 'Luis Molowny',
             'descripcion' => 'Primera UEFA del Valencia CF ante el Arsenal en el estadio Heysel de Bruselas. Ganada en la tanda de penaltis.'],

            // RECOPA DE EUROPA
            ['competicion' => 'Recopa de Europa', 'anio' => 1980, 'entrenador' => 'Luis Molowny',
             'descripcion' => 'Recopa de Europa ganada ante el Arsenal FC. Año histórico con dos títulos europeos en una sola temporada.'],

            // SUPERCOPA DE ESPAÑA
            ['competicion' => 'Supercopa de España', 'anio' => 1999, 'entrenador' => 'Claudio Ranieri',
             'descripcion' => 'Supercopa conquistada ante el Barcelona, confirmando el gran momento del equipo a finales de los 90.'],

            // COPA EVA DUARTE (precursora Supercopa)
            ['competicion' => 'Copa Eva Duarte', 'anio' => 1949, 'entrenador' => 'Ramón Encinas',
             'descripcion' => 'Copa Eva Duarte, precursora de la actual Supercopa de España, ganada en la época dorada del club.'],
            ['competicion' => 'Copa Eva Duarte', 'anio' => 1947, 'entrenador' => 'Ramón Encinas',
             'descripcion' => 'Segundo título de la Copa Eva Duarte para el Valencia CF.'],

            // INTERTOTO
            ['competicion' => 'Copa Intertoto UEFA', 'anio' => 1998, 'entrenador' => 'Jorge Valdano',
             'descripcion' => 'Copa Intertoto ganada, que supuso el trampolín para la posterior era dorada del equipo bajo Claudio Ranieri.'],
        ];

        foreach ($titulos as $t) {
            Titulo::create($t);
        }
    }
}