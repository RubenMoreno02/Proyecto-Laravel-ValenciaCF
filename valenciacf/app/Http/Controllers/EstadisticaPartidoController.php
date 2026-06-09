<?php
namespace App\Http\Controllers;

use App\Models\EstadisticaPartido;
use App\Models\Partido;
use App\Models\Jugador;
use Illuminate\Http\Request;

class EstadisticaPartidoController extends Controller
{
    // Formulario para añadir/editar estadísticas de un partido
    public function edit(Partido $partido)
    {
        $jugadores = Jugador::where('activo', true)->orderBy('dorsal')->get();

        // Estadísticas ya registradas, indexadas por jugador_id
        $existentes = $partido->estadisticas->keyBy('jugador_id');

        return view('estadisticas.partido', compact('partido', 'jugadores', 'existentes'));
    }

    // Guardar todas las estadísticas de un partido
    public function update(Request $request, Partido $partido)
    {
        $data = $request->validate([
            'jugadores'                    => 'nullable|array',
            'jugadores.*.jugador_id'       => 'required|exists:jugadores,id',
            'jugadores.*.minutos_jugados'  => 'required|integer|min:0|max:120',
            'jugadores.*.goles'            => 'required|integer|min:0',
            'jugadores.*.asistencias'      => 'required|integer|min:0',
            'jugadores.*.amarillas'        => 'required|integer|min:0|max:2',
            'jugadores.*.rojas'            => 'required|integer|min:0|max:1',
            'jugadores.*.faltas_cometidas' => 'required|integer|min:0',
            'jugadores.*.faltas_recibidas' => 'required|integer|min:0',
            'jugadores.*.portero_imbatido' => 'nullable|boolean',
            'jugadores.*.titular'          => 'nullable|boolean',
        ]);

        // Borra las anteriores y vuelve a insertar
        $partido->estadisticas()->delete();

        if (!empty($data['jugadores'])) {
            foreach ($data['jugadores'] as $fila) {
                EstadisticaPartido::create([
                    'partido_id'       => $partido->id,
                    'jugador_id'       => $fila['jugador_id'],
                    'minutos_jugados'  => $fila['minutos_jugados'],
                    'goles'            => $fila['goles'],
                    'asistencias'      => $fila['asistencias'],
                    'amarillas'        => $fila['amarillas'],
                    'rojas'            => $fila['rojas'],
                    'faltas_cometidas' => $fila['faltas_cometidas'],
                    'faltas_recibidas' => $fila['faltas_recibidas'],
                    'portero_imbatido' => isset($fila['portero_imbatido']) ? 1 : 0,
                    'titular'          => isset($fila['titular']) ? 1 : 0,
                ]);
            }
        }

        return redirect()->route('partidos.show', $partido)
                         ->with('success', 'Estadísticas guardadas correctamente.');
    }
}