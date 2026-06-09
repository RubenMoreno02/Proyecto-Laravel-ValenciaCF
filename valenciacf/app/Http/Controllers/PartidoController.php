<?php
namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Jugador;
use App\Models\EstadisticaPartido;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Partido::orderBy('fecha', 'desc');

        if ($request->filled('competicion')) {
            $query->where('competicion', $request->competicion);
        }

        $partidos = $query->paginate(15);
        return view('partidos.index', compact('partidos'));
    }

    public function show(Partido $partido)
    {
        $estadisticas = $partido->estadisticas()->with('jugador')->get();
        return view('partidos.show', compact('partido', 'estadisticas'));
    }

    public function create()
    {
        $jugadores = Jugador::where('activo', true)->orderBy('dorsal')->get();
        return view('partidos.form', ['partido' => new Partido(), 'jugadores' => $jugadores]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'rival'        => 'required|max:100',
            'fecha'        => 'required|date',
            'competicion'  => 'required',
            'jornada'      => 'nullable|integer|min:1|max:38',
            'sede'         => 'required|in:Local,Visitante',
            'goles_favor'  => 'required|integer|min:0',
            'goles_contra' => 'required|integer|min:0',
            'estadio'      => 'nullable|max:100',
        ]);

        $partido = Partido::create($data);
        return redirect()->route('partidos.show', $partido)->with('success', 'Partido registrado.');
    }

    public function edit(Partido $partido)
    {
        $jugadores = Jugador::where('activo', true)->orderBy('dorsal')->get();
        return view('partidos.form', compact('partido', 'jugadores'));
    }

    public function update(Request $request, Partido $partido)
    {
        $data = $request->validate([
            'rival'        => 'required|max:100',
            'fecha'        => 'required|date',
            'competicion'  => 'required',
            'jornada'      => 'nullable|integer',
            'sede'         => 'required|in:Local,Visitante',
            'goles_favor'  => 'required|integer|min:0',
            'goles_contra' => 'required|integer|min:0',
            'estadio'      => 'nullable|max:100',
        ]);

        $partido->update($data);
        return redirect()->route('partidos.show', $partido)->with('success', 'Partido actualizado.');
    }

    public function destroy(Partido $partido)
    {
        $partido->delete(); // Cascade borra las estadísticas
        return redirect()->route('partidos.index')->with('success', 'Partido eliminado.');
    }
}