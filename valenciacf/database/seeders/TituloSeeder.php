<?php
namespace Database\Seeders;

use App\Models\Titulo;
use Illuminate\Database\Seeder;

class TituloSeeder extends Seeder
{
    public function run(): void
    {
        $titulos = [
            ['competicion' => 'Liga Española', 'anio' => 2002, 'entrenador' => 'Rafa Benítez', 'descripcion' => 'Segunda Liga de la historia del club.'],
            ['competicion' => 'Liga Española', 'anio' => 1971, 'entrenador' => 'Alfredo Di Stéfano', 'descripcion' => 'Primera Liga de la historia del Valencia CF.'],
            ['competicion' => 'Copa del Rey',  'anio' => 2008, 'entrenador' => 'Ronald Koeman', 'descripcion' => 'Copa del Rey ganada ante el Getafe.'],
            ['competicion' => 'UEFA',          'anio' => 2004, 'entrenador' => 'Rafa Benítez', 'descripcion' => 'Segunda UEFA del club, ganada en Göteborg.'],
            ['competicion' => 'UEFA',          'anio' => 1980, 'entrenador' => 'Luis Molowny', 'descripcion' => 'Primera UEFA, ganada ante el Arsenal.'],
            ['competicion' => 'Recopa de Europa', 'anio' => 1980, 'entrenador' => 'Luis Molowny', 'descripcion' => 'Recopa de Europa ganada en Bruselas.'],
        ];

        foreach ($titulos as $t) {
            Titulo::create($t);
        }
    }
}