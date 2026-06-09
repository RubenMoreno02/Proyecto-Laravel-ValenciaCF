<?php
namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JugadorController extends Controller
{
    public function index(Request $request)
    {
        $query = Jugador::where('activo', true);

        if ($request->filled('posicion')) {
            $query->where('posicion', $request->posicion);
        }
        if ($request->filled('buscar')) {
            $query->where('nombre', 'like', '%' . $request->buscar . '%');
        }

        $jugadores = $query->orderBy('dorsal')->paginate(15);
        return view('jugadores.index', compact('jugadores'));
    }

    public function show(Jugador $jugador)
    {
        $stats = calcularEstadisticasTemporada($jugador->id);
        $lesiones = $jugador->lesiones()->orderBy('fecha_inicio', 'desc')->get();
        $partidos = $jugador->partidos()->orderBy('fecha', 'desc')->get();
        return view('jugadores.show', compact('jugador', 'stats', 'lesiones', 'partidos'));
    }

    public function create()
    {
        return view('jugadores.form', ['jugador' => new Jugador()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'            => 'required|max:100',
            'dorsal'            => 'required|integer|min:1|max:99|unique:jugadores',
            'posicion'          => 'required|in:Portero,Defensa,Medio,Delantero',
            'nacionalidad'      => 'required|max:60',
            'fecha_nacimiento'  => 'required|date|before:today',
            'altura_cm'         => 'nullable|integer|min:100|max:230',
            'peso_kg'           => 'nullable|numeric|min:40|max:150',
            'fecha_incorporacion' => 'required|date',
            'foto'              => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto_url'] = $request->file('foto')->store('jugadores', 'public');
        }

        Jugador::create($data);
        return redirect()->route('jugadores.index')->with('success', 'Jugador creado correctamente.');
    }

    public function edit(Jugador $jugador)
    {
        return view('jugadores.form', compact('jugador'));
    }

    public function update(Request $request, Jugador $jugador)
    {
        $data = $request->validate([
            'nombre'            => 'required|max:100',
            'dorsal'            => 'required|integer|min:1|max:99|unique:jugadores,dorsal,' . $jugador->id,
            'posicion'          => 'required|in:Portero,Defensa,Medio,Delantero',
            'nacionalidad'      => 'required|max:60',
            'fecha_nacimiento'  => 'required|date|before:today',
            'altura_cm'         => 'nullable|integer',
            'peso_kg'           => 'nullable|numeric',
            'fecha_incorporacion' => 'required|date',
            'foto'              => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($jugador->foto_url) {
                Storage::disk('public')->delete($jugador->foto_url);
            }
            $data['foto_url'] = $request->file('foto')->store('jugadores', 'public');
        }

        $jugador->update($data);
        return redirect()->route('jugadores.show', $jugador)->with('success', 'Jugador actualizado.');
    }

    public function destroy(Jugador $jugador)
    {
        // Baja lógica: no borrado físico
        $jugador->update(['activo' => false]);
        return redirect()->route('jugadores.index')->with('success', 'Jugador dado de baja.');
    }
}