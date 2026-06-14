<?php
namespace Database\Seeders;

use App\Models\Lesion;
use App\Models\Jugador;
use Illuminate\Database\Seeder;

class LesionSeeder extends Seeder
{
    public function run(): void
    {
        $lesiones = [
            [
                'dorsal' => 14, // Gayà
                'tipo_lesion' => 'Rotura del ligamento cruzado anterior',
                'parte_cuerpo' => 'Rodilla izquierda',
                'fecha_inicio' => '2025-11-15',
                'fecha_estimada_vuelta' => '2026-08-01',
                'dias_estimados' => 259,
                'estado' => 'Baja larga',
                'observaciones' => 'Intervención quirúrgica el 20 de noviembre. El capitán no volverá hasta la próxima temporada.',
            ],
            [
                'dorsal' => 10, // Rafa Mir
                'tipo_lesion' => 'Rotura fibrilar en el bíceps femoral',
                'parte_cuerpo' => 'Muslo derecho',
                'fecha_inicio' => '2026-02-22',
                'fecha_estimada_vuelta' => '2026-04-15',
                'dias_estimados' => 52,
                'estado' => 'En tratamiento',
                'observaciones' => 'Se espera que el delantero pueda volver antes del final de temporada si la recuperación sigue su curso.',
            ],
            [
                'dorsal' => 21, // Foulquier
                'tipo_lesion' => 'Esguince de tobillo grado II',
                'parte_cuerpo' => 'Tobillo derecho',
                'fecha_inicio' => '2026-03-08',
                'fecha_estimada_vuelta' => '2026-04-01',
                'dias_estimados' => 24,
                'estado' => 'En tratamiento',
                'observaciones' => 'Lesión producida en el partido ante el Leganés. Evolución favorable.',
            ],
            [
                'dorsal' => 22, // Kluivert
                'tipo_lesion' => 'Contractura en el sóleo',
                'parte_cuerpo' => 'Gemelo izquierdo',
                'fecha_inicio' => '2026-03-20',
                'fecha_estimada_vuelta' => '2026-04-05',
                'dias_estimados' => 16,
                'estado' => 'En tratamiento',
                'observaciones' => 'El delantero holandés se perdió los últimos dos encuentros. Regreso previsto para el próximo partido.',
            ],
            // RECUPERADOS
            [
                'dorsal' => 9, // Hugo Duro
                'tipo_lesion' => 'Esguince de rodilla grado I',
                'parte_cuerpo' => 'Rodilla derecha',
                'fecha_inicio' => '2025-10-10',
                'fecha_estimada_vuelta' => '2025-11-01',
                'dias_estimados' => 22,
                'estado' => 'Recuperado',
                'observaciones' => 'El delantero se recuperó sin problemas y volvió antes de lo esperado.',
            ],
            [
                'dorsal' => 5, // Mosquera
                'tipo_lesion' => 'Sobrecarga muscular en el cuádriceps',
                'parte_cuerpo' => 'Muslo izquierdo',
                'fecha_inicio' => '2025-09-05',
                'fecha_estimada_vuelta' => '2025-09-20',
                'dias_estimados' => 15,
                'estado' => 'Recuperado',
                'observaciones' => 'Descansó dos jornadas como medida preventiva.',
            ],
        ];

        foreach ($lesiones as $l) {
            $jugador = Jugador::where('dorsal', $l['dorsal'])->first();
            if (!$jugador) continue;
            Lesion::create([
                'jugador_id'            => $jugador->id,
                'tipo_lesion'           => $l['tipo_lesion'],
                'parte_cuerpo'          => $l['parte_cuerpo'],
                'fecha_inicio'          => $l['fecha_inicio'],
                'fecha_estimada_vuelta' => $l['fecha_estimada_vuelta'],
                'dias_estimados'        => $l['dias_estimados'],
                'estado'                => $l['estado'],
                'observaciones'         => $l['observaciones'],
            ]);
        }

        $this->command->info('✅ Lesiones creadas.');
    }
}