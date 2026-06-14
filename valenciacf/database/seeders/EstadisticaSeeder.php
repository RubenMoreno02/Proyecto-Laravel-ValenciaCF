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
        $partidos = Partido::orderBy('fecha')->get();
        $jugadores = Jugador::all()->keyBy('dorsal');

        // [partido_idx, dorsal, min, goles, asist, amarillas, rojas, f_com, f_rec, portero_imb, titular, mvp]
        $datos = [
            // J1: VCF 1-0 Mallorca
            [0,25,90,0,0,0,0,0,0,true, true, false],
            [0,2, 90,0,0,0,0,1,2,false,true, false],
            [0,5, 90,0,0,0,0,2,1,false,true, false],
            [0,4, 90,0,0,0,0,1,0,false,true, false],
            [0,14,90,0,1,0,0,0,3,false,true, false],
            [0,8, 90,0,0,1,0,2,2,false,true, false],
            [0,6, 90,0,0,0,0,1,1,false,true, false],
            [0,16,80,0,0,0,0,1,1,false,true, false],
            [0,11,90,1,0,0,0,1,2,false,true, true],
            [0,9, 90,0,0,0,0,2,3,false,true, false],
            [0,7, 70,0,0,0,0,1,1,false,false,false],

            // J2: Betis 2-1 VCF
            [1,25,90,0,0,0,0,0,0,false,true, false],
            [1,2, 90,0,0,1,0,2,1,false,true, false],
            [1,5, 90,0,0,0,0,1,0,false,true, false],
            [1,4, 90,0,0,0,0,2,1,false,true, false],
            [1,14,90,0,0,0,0,0,2,false,true, false],
            [1,8, 90,1,0,0,0,2,2,false,true, true],
            [1,6, 90,0,0,0,0,1,1,false,true, false],
            [1,16,60,0,0,0,0,1,0,false,true, false],
            [1,18,30,0,0,0,0,0,1,false,false,false],
            [1,9, 90,0,0,0,0,1,3,false,true, false],
            [1,7, 90,0,0,0,0,2,2,false,true, false],

            // J3: VCF 2-0 Alavés
            [2,25,90,0,0,0,0,0,0,true, true, false],
            [2,2, 90,0,1,0,0,1,2,false,true, false],
            [2,5, 90,0,0,0,0,1,0,false,true, false],
            [2,4, 90,0,0,0,0,1,1,false,true, false],
            [2,14,90,0,0,0,0,0,3,false,true, false],
            [2,8, 90,1,0,0,0,2,1,false,true, false],
            [2,6, 90,0,1,0,0,1,2,false,true, false],
            [2,16,90,0,0,0,0,2,1,false,true, false],
            [2,11,90,0,0,0,0,1,1,false,true, false],
            [2,9, 90,1,0,0,0,1,4,false,true, true],
            [2,7, 75,0,0,0,0,1,2,false,false,false],

            // J4: Girona 1-0 VCF
            [3,25,90,0,0,0,0,0,0,false,true, false],
            [3,2, 90,0,0,1,0,3,1,false,true, false],
            [3,5, 90,0,0,0,0,1,0,false,true, false],
            [3,4, 90,0,0,0,0,2,1,false,true, false],
            [3,15,90,0,0,0,0,1,2,false,true, false],
            [3,8, 90,0,0,0,0,2,2,false,true, false],
            [3,6, 90,0,0,0,0,1,1,false,true, false],
            [3,16,70,0,0,0,0,1,1,false,true, false],
            [3,18,20,0,0,0,0,0,0,false,false,false],
            [3,9, 80,0,0,0,0,2,3,false,true, false],
            [3,7, 90,0,0,0,0,1,2,false,true, false],

            // J5: VCF 3-1 Leganés
            [4,25,90,0,0,0,0,0,0,false,true, false],
            [4,2, 90,0,0,0,0,1,2,false,true, false],
            [4,5, 90,1,0,0,0,0,0,false,true, false],
            [4,4, 90,0,0,0,0,1,1,false,true, false],
            [4,14,90,0,1,0,0,0,3,false,true, false],
            [4,8, 90,1,1,0,0,2,1,false,true, true],
            [4,6, 90,0,1,0,0,1,2,false,true, false],
            [4,16,90,0,0,0,0,1,1,false,true, false],
            [4,11,90,0,1,0,0,1,2,false,true, false],
            [4,9, 90,1,0,0,0,2,4,false,true, false],
            [4,7, 80,0,0,0,0,1,1,false,false,false],

            // J6: Rayo 1-1 VCF
            [5,25,90,0,0,0,0,0,0,false,true, false],
            [5,2, 90,0,0,0,0,2,1,false,true, false],
            [5,5, 90,0,0,1,0,2,1,false,true, false],
            [5,4, 90,0,0,0,0,1,0,false,true, false],
            [5,14,90,0,0,0,0,0,2,false,true, false],
            [5,8, 90,0,0,0,0,2,2,false,true, false],
            [5,6, 90,0,0,0,0,1,1,false,true, false],
            [5,16,90,1,0,0,0,1,1,false,true, true],
            [5,11,90,0,0,0,0,1,2,false,true, false],
            [5,9, 90,0,0,0,0,2,3,false,true, false],
            [5,7, 80,0,0,0,0,1,1,false,false,false],

            // J7: VCF 2-1 Espanyol
            [6,25,90,0,0,0,0,0,0,false,true, false],
            [6,2, 90,0,0,0,0,1,2,false,true, false],
            [6,5, 90,0,0,0,0,1,0,false,true, false],
            [6,4, 90,0,0,0,0,1,1,false,true, false],
            [6,14,90,0,1,0,0,0,3,false,true, false],
            [6,8, 90,0,0,1,0,2,2,false,true, false],
            [6,6, 90,0,1,0,0,1,2,false,true, false],
            [6,16,70,0,0,0,0,1,0,false,true, false],
            [6,11,90,1,0,0,0,1,2,false,true, false],
            [6,9, 90,1,0,0,0,2,4,false,true, true],
            [6,7, 75,0,0,0,0,1,1,false,false,false],

            // J8: Athletic 2-0 VCF
            [7,25,90,0,0,0,0,0,0,false,true, false],
            [7,21,90,0,0,1,0,3,1,false,true, false],
            [7,5, 90,0,0,0,0,1,0,false,true, false],
            [7,4, 90,0,0,0,0,2,1,false,true, false],
            [7,14,90,0,0,0,0,1,2,false,true, false],
            [7,8, 90,0,0,0,0,2,2,false,true, false],
            [7,6, 90,0,0,0,0,1,1,false,true, false],
            [7,16,90,0,0,0,0,1,1,false,true, false],
            [7,11,80,0,0,0,0,1,2,false,true, false],
            [7,9, 80,0,0,0,0,2,3,false,true, false],
            [7,7, 90,0,0,0,0,2,2,false,true, false],

            // J9: VCF 2-2 Real Madrid
            [8,25,90,0,0,0,0,0,0,false,true, false],
            [8,2, 90,0,0,0,0,1,2,false,true, false],
            [8,5, 90,0,0,1,0,2,1,false,true, false],
            [8,4, 90,0,0,0,0,1,1,false,true, false],
            [8,14,90,0,1,0,0,0,3,false,true, false],
            [8,8, 90,1,0,0,0,2,2,false,true, false],
            [8,6, 90,0,1,0,0,1,2,false,true, false],
            [8,16,90,0,0,0,0,1,1,false,true, false],
            [8,11,90,0,0,0,0,1,2,false,true, false],
            [8,9, 90,1,0,0,0,2,4,false,true, true],
            [8,7, 80,0,0,0,0,1,1,false,false,false],

            // J10: Getafe 0-1 VCF
            [9,25,90,0,0,0,0,0,0,true, true, true],
            [9,2, 90,0,0,0,0,1,1,false,true, false],
            [9,5, 90,0,0,0,0,1,0,false,true, false],
            [9,4, 90,0,0,0,0,2,1,false,true, false],
            [9,14,90,0,0,0,0,0,2,false,true, false],
            [9,8, 90,0,0,0,0,2,2,false,true, false],
            [9,6, 90,0,0,0,0,1,1,false,true, false],
            [9,16,90,0,0,0,0,1,1,false,true, false],
            [9,11,90,1,0,0,0,1,2,false,true, false],
            [9,9, 90,0,0,0,0,1,3,false,true, false],
            [9,7, 80,0,0,0,0,1,1,false,false,false],

            // J11: VCF 1-1 Real Sociedad
            [10,25,90,0,0,0,0,0,0,false,true, false],
            [10,2, 90,0,0,1,0,2,1,false,true, false],
            [10,5, 90,0,0,0,0,1,0,false,true, false],
            [10,4, 90,0,0,0,0,1,1,false,true, false],
            [10,14,90,0,1,0,0,0,3,false,true, false],
            [10,8, 90,0,0,0,0,2,2,false,true, false],
            [10,6, 90,0,0,0,0,1,1,false,true, false],
            [10,16,90,0,0,0,0,2,1,false,true, false],
            [10,11,90,1,0,0,0,1,2,false,true, true],
            [10,9, 90,0,0,0,0,2,3,false,true, false],
            [10,7, 80,0,0,0,0,1,1,false,false,false],

            // J12: Sevilla 2-0 VCF
            [11,25,90,0,0,0,0,0,0,false,true, false],
            [11,21,90,0,0,0,0,2,1,false,true, false],
            [11,5, 90,0,0,0,0,1,0,false,true, false],
            [11,4, 90,0,0,1,0,2,1,false,true, false],
            [11,14,90,0,0,0,0,1,2,false,true, false],
            [11,8, 90,0,0,1,0,3,2,false,true, false],
            [11,6, 90,0,0,0,0,1,1,false,true, false],
            [11,16,70,0,0,0,0,1,0,false,true, false],
            [11,18,20,0,0,0,0,0,1,false,false,false],
            [11,9, 80,0,0,0,0,1,3,false,true, false],
            [11,7, 90,0,0,0,0,2,2,false,true, false],

            // J13: VCF 3-0 Villarreal
            [12,25,90,0,0,0,0,0,0,true, true, false],
            [12,2, 90,0,1,0,0,1,2,false,true, false],
            [12,5, 90,0,0,0,0,1,0,false,true, false],
            [12,4, 90,0,0,0,0,1,1,false,true, false],
            [12,14,90,0,0,0,0,0,3,false,true, false],
            [12,8, 90,1,1,0,0,2,1,false,true, true],
            [12,6, 90,0,1,0,0,1,2,false,true, false],
            [12,16,90,0,0,0,0,1,1,false,true, false],
            [12,11,90,1,0,0,0,1,2,false,true, false],
            [12,9, 90,1,0,0,0,2,4,false,true, false],
            [12,7, 80,0,0,0,0,1,1,false,false,false],

            // J14: Atlético 1-0 VCF
            [13,25,90,0,0,0,0,0,0,false,true, false],
            [13,2, 90,0,0,0,0,2,1,false,true, false],
            [13,5, 90,0,0,1,0,2,0,false,true, false],
            [13,4, 90,0,0,0,0,1,1,false,true, false],
            [13,14,90,0,0,0,0,1,2,false,true, false],
            [13,8, 90,0,0,0,0,2,2,false,true, false],
            [13,6, 90,0,0,0,0,1,1,false,true, false],
            [13,16,60,0,0,0,0,1,0,false,true, false],
            [13,18,30,0,0,0,0,1,1,false,false,false],
            [13,9, 90,0,0,0,0,1,3,false,true, false],
            [13,7, 90,0,0,0,0,2,2,false,true, false],

            // J15: VCF 1-2 Barcelona
            [14,25,90,0,0,0,0,0,0,false,true, false],
            [14,2, 90,0,0,0,0,1,2,false,true, false],
            [14,5, 90,0,0,0,0,2,1,false,true, false],
            [14,4, 90,0,0,1,0,2,1,false,true, false],
            [14,14,90,0,0,0,0,0,3,false,true, false],
            [14,8, 90,0,0,0,0,2,2,false,true, false],
            [14,6, 90,0,1,0,0,1,1,false,true, false],
            [14,16,90,1,0,0,0,1,1,false,true, true],
            [14,11,80,0,0,0,0,1,2,false,true, false],
            [14,9, 90,0,0,0,0,2,3,false,true, false],
            [14,7, 80,0,0,0,0,1,1,false,false,false],

            // J16: Celta 1-2 VCF
            [15,25,90,0,0,0,0,0,0,false,true, false],
            [15,2, 90,0,1,0,0,1,2,false,true, false],
            [15,5, 90,0,0,0,0,1,0,false,true, false],
            [15,4, 90,0,0,0,0,1,1,false,true, false],
            [15,14,90,0,0,0,0,0,3,false,true, false],
            [15,8, 90,0,0,0,0,2,2,false,true, false],
            [15,6, 90,0,1,0,0,1,2,false,true, false],
            [15,16,90,1,0,0,0,1,1,false,true, false],
            [15,11,90,0,0,0,0,1,2,false,true, false],
            [15,9, 90,1,0,0,0,2,4,false,true, true],
            [15,7, 80,0,0,0,0,1,1,false,false,false],

            // J17: VCF 3-0 Las Palmas
            [16,25,90,0,0,0,0,0,0,true, true, false],
            [16,2, 90,0,0,0,0,1,2,false,true, false],
            [16,5, 90,1,0,0,0,0,0,false,true, false],
            [16,4, 90,0,0,0,0,1,1,false,true, false],
            [16,14,90,0,1,0,0,0,3,false,true, false],
            [16,8, 90,1,1,0,0,2,1,false,true, true],
            [16,6, 90,0,1,0,0,1,2,false,true, false],
            [16,16,90,0,0,0,0,1,1,false,true, false],
            [16,11,90,0,0,0,0,1,2,false,true, false],
            [16,9, 90,1,0,0,0,2,4,false,true, false],
            [16,7, 75,0,0,0,0,1,1,false,false,false],

            // J18: Valladolid 0-2 VCF
            [17,25,90,0,0,0,0,0,0,true, true, true],
            [17,2, 90,0,0,0,0,1,1,false,true, false],
            [17,5, 90,0,0,0,0,1,0,false,true, false],
            [17,4, 90,0,0,0,0,1,1,false,true, false],
            [17,14,90,0,1,0,0,0,2,false,true, false],
            [17,8, 90,0,0,0,0,2,2,false,true, false],
            [17,6, 90,0,1,0,0,1,1,false,true, false],
            [17,16,90,1,0,0,0,1,1,false,true, false],
            [17,11,90,0,0,0,0,1,2,false,true, false],
            [17,9, 90,1,0,0,0,2,4,false,true, false],
            [17,7, 80,0,0,0,0,1,1,false,false,false],

            // Copa: VCF 3-1 Mallorca
            [18,25,90,0,0,0,0,0,0,false,true, false],
            [18,2, 90,0,1,0,0,1,2,false,true, false],
            [18,3, 90,0,0,0,0,1,0,false,true, false],
            [18,4, 90,0,0,0,0,1,1,false,true, false],
            [18,15,90,0,0,0,0,0,2,false,true, false],
            [18,18,90,1,0,1,0,2,1,false,true, true],
            [18,17,90,0,1,0,0,1,2,false,true, false],
            [18,16,80,0,0,0,0,1,1,false,true, false],
            [18,11,90,0,1,0,0,1,2,false,true, false],
            [18,10,90,2,0,0,0,1,3,false,true, false],
            [18,22,75,0,0,0,0,1,2,false,false,false],

            // J19: VCF 1-0 Osasuna
            [19,25,90,0,0,0,0,0,0,true, true, true],
            [19,2, 90,0,0,0,0,1,2,false,true, false],
            [19,5, 90,0,0,0,0,1,0,false,true, false],
            [19,4, 90,0,0,0,0,1,1,false,true, false],
            [19,14,90,0,0,0,0,0,3,false,true, false],
            [19,8, 90,0,0,0,0,2,2,false,true, false],
            [19,6, 90,0,0,0,0,1,1,false,true, false],
            [19,16,90,1,0,0,0,1,1,false,true, false],
            [19,11,80,0,0,0,0,1,2,false,true, false],
            [19,9, 90,0,0,0,0,2,3,false,true, false],
            [19,7, 75,0,0,0,0,1,1,false,false,false],

            // Copa vuelta: Atlético 1-1 VCF
            [20,25,90,0,0,0,0,0,0,false,true, false],
            [20,21,90,0,0,1,0,2,1,false,true, false],
            [20,3, 90,0,0,0,0,1,0,false,true, false],
            [20,4, 90,0,0,0,0,1,1,false,true, false],
            [20,15,90,0,0,0,0,0,2,false,true, false],
            [20,18,90,0,0,0,0,2,1,false,true, false],
            [20,17,90,1,0,0,0,1,2,false,true, true],
            [20,16,90,0,0,0,0,1,1,false,true, false],
            [20,11,80,0,0,0,0,1,2,false,true, false],
            [20,10,90,0,0,0,0,1,3,false,true, false],
            [20,22,75,0,0,0,0,1,1,false,false,false],

            // J20: Mallorca 1-1 VCF
            [21,25,90,0,0,0,0,0,0,false,true, false],
            [21,2, 90,0,0,0,0,2,1,false,true, false],
            [21,5, 90,0,0,1,0,2,0,false,true, false],
            [21,4, 90,0,0,0,0,1,1,false,true, false],
            [21,14,90,0,0,0,0,1,2,false,true, false],
            [21,8, 90,0,0,0,0,2,2,false,true, false],
            [21,6, 90,0,0,0,0,1,1,false,true, false],
            [21,16,90,1,0,0,0,1,1,false,true, true],
            [21,11,80,0,0,0,0,1,2,false,true, false],
            [21,9, 90,0,0,0,0,2,3,false,true, false],
            [21,7, 80,0,0,0,0,1,1,false,false,false],

            // J21: VCF 2-0 Betis
            [22,25,90,0,0,0,0,0,0,true, true, false],
            [22,2, 90,0,0,0,0,1,2,false,true, false],
            [22,5, 90,0,0,0,0,1,0,false,true, false],
            [22,4, 90,0,0,0,0,1,1,false,true, false],
            [22,14,90,0,1,0,0,0,3,false,true, false],
            [22,8, 90,1,0,0,0,2,1,false,true, true],
            [22,6, 90,0,1,0,0,1,2,false,true, false],
            [22,16,90,0,0,0,0,1,1,false,true, false],
            [22,11,90,0,0,0,0,1,2,false,true, false],
            [22,9, 90,1,0,0,0,2,4,false,true, false],
            [22,7, 80,0,0,0,0,1,1,false,false,false],

            // J22: Alavés 0-1 VCF
            [23,25,90,0,0,0,0,0,0,true, true, true],
            [23,2, 90,0,0,0,0,1,1,false,true, false],
            [23,5, 90,0,0,0,0,1,0,false,true, false],
            [23,4, 90,0,0,0,0,1,1,false,true, false],
            [23,14,90,0,0,0,0,0,2,false,true, false],
            [23,8, 90,0,0,0,0,2,2,false,true, false],
            [23,6, 90,0,1,0,0,1,1,false,true, false],
            [23,16,90,1,0,0,0,1,1,false,true, false],
            [23,11,90,0,0,0,0,1,2,false,true, false],
            [23,9, 90,0,0,0,0,2,3,false,true, false],
            [23,7, 80,0,0,0,0,1,1,false,false,false],

            // J23: VCF 2-1 Girona
            [24,25,90,0,0,0,0,0,0,false,true, false],
            [24,2, 90,0,1,0,0,1,2,false,true, false],
            [24,5, 90,0,0,0,0,1,0,false,true, false],
            [24,4, 90,0,0,0,0,1,1,false,true, false],
            [24,14,90,0,0,0,0,0,3,false,true, false],
            [24,8, 90,1,0,1,0,2,2,false,true, false],
            [24,6, 90,0,1,0,0,1,2,false,true, false],
            [24,16,90,0,0,0,0,1,1,false,true, false],
            [24,11,90,0,0,0,0,1,2,false,true, false],
            [24,9, 90,1,0,0,0,2,4,false,true, true],
            [24,7, 80,0,0,0,0,1,1,false,false,false],

            // J24: Leganés 0-0 VCF
            [25,25,90,0,0,0,0,0,0,false,true, false],
            [25,2, 90,0,0,1,0,2,1,false,true, false],
            [25,5, 90,0,0,0,0,1,0,false,true, false],
            [25,4, 90,0,0,0,0,2,1,false,true, false],
            [25,14,90,0,0,0,0,1,2,false,true, false],
            [25,8, 90,0,0,0,0,2,2,false,true, false],
            [25,6, 90,0,0,0,0,1,1,false,true, false],
            [25,16,90,0,0,0,0,1,1,false,true, false],
            [25,11,80,0,0,0,0,1,2,false,true, false],
            [25,9, 90,0,0,0,0,2,3,false,true, false],
            [25,7, 80,0,0,0,0,1,1,false,false,false],

            // J25: VCF 3-1 Rayo
            [26,25,90,0,0,0,0,0,0,false,true, false],
            [26,2, 90,0,0,0,0,1,2,false,true, false],
            [26,5, 90,0,0,0,0,1,0,false,true, false],
            [26,4, 90,0,0,0,0,1,1,false,true, false],
            [26,14,90,0,1,0,0,0,3,false,true, false],
            [26,8, 90,1,1,0,0,2,1,false,true, true],
            [26,6, 90,0,1,0,0,1,2,false,true, false],
            [26,16,90,0,0,0,0,1,1,false,true, false],
            [26,11,90,1,0,0,0,1,2,false,true, false],
            [26,9, 90,1,0,0,0,2,4,false,true, false],
            [26,7, 80,0,0,0,0,1,1,false,false,false],

            // J26: Espanyol 1-1 VCF
            [27,25,90,0,0,0,0,0,0,false,true, false],
            [27,2, 90,0,0,0,0,2,1,false,true, false],
            [27,5, 90,0,0,1,0,2,0,false,true, false],
            [27,4, 90,0,0,0,0,1,1,false,true, false],
            [27,14,90,0,0,0,0,1,2,false,true, false],
            [27,8, 90,1,0,0,0,2,2,false,true, true],
            [27,6, 90,0,0,0,0,1,1,false,true, false],
            [27,16,90,0,0,0,0,1,1,false,true, false],
            [27,11,80,0,0,0,0,1,2,false,true, false],
            [27,9, 90,0,0,0,0,2,3,false,true, false],
            [27,7, 80,0,0,0,0,1,1,false,false,false],

            // J27: VCF 2-0 Athletic
            [28,25,90,0,0,0,0,0,0,true, true, false],
            [28,2, 90,0,1,0,0,1,2,false,true, false],
            [28,5, 90,0,0,0,0,1,0,false,true, false],
            [28,4, 90,0,0,0,0,1,1,false,true, false],
            [28,14,90,0,0,0,0,0,3,false,true, false],
            [28,8, 90,1,0,0,0,2,2,false,true, false],
            [28,6, 90,0,1,0,0,1,2,false,true, false],
            [28,16,90,0,0,0,0,1,1,false,true, false],
            [28,11,90,0,0,0,0,1,2,false,true, false],
            [28,9, 90,1,0,0,0,2,4,false,true, true],
            [28,7, 80,0,0,0,0,1,1,false,false,false],

            // J28: Real Madrid 3-0 VCF
            [29,25,90,0,0,0,0,0,0,false,true, false],
            [29,2, 90,0,0,1,0,3,1,false,true, false],
            [29,5, 90,0,0,0,0,2,0,false,true, false],
            [29,4, 90,0,0,0,1,2,1,false,true, false],
            [29,14,90,0,0,0,0,1,2,false,true, false],
            [29,8, 90,0,0,1,0,3,2,false,true, false],
            [29,6, 90,0,0,0,0,1,1,false,true, false],
            [29,16,70,0,0,0,0,1,0,false,true, false],
            [29,18,20,0,0,0,0,0,1,false,false,false],
            [29,9, 80,0,0,0,0,2,3,false,true, false],
            [29,7, 90,0,0,0,0,2,2,false,true, false],
        ];

        foreach ($datos as $fila) {
            [$pIdx,$dorsal,$min,$goles,$asist,$amar,$rojas,$fCom,$fRec,$portImb,$titular,$mvp] = $fila;
            $partido = $partidos->get($pIdx);
            $jugador = $jugadores->get($dorsal);
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
                'portero_imbatido' => $portImb,
                'titular'          => $titular,
                'mvp'              => $mvp,
            ]);
        }
        $this->command->info('✅ Estadísticas reales creadas.');
    }
}