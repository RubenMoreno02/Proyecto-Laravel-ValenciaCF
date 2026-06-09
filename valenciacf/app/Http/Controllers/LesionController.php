<?php
namespace App\Http\Controllers;

use App\Models\Lesion;
use App\Models\Jugador;
use Illuminate\Http\Request;

class LesionController extends Controller
{
    public function index()
    {
        $lesionesActivas = Lesion::activas()
            ->with('jugador')
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(15);

        return view('lesiones.index', compact('lesionesActivas'));
    }

    public function create()
    {
        $jugadores = Jugador::where('activo', true)->orderBy('nombre')->get();
        return view('lesiones.form', ['lesion' => new Lesion(), 'jugadores' => $jugadores]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'jugador_id'            => 'required|exists:jugadores,id',
            'tipo_lesion'           => 'required|max:120',
            'fecha_inicio'          => 'required|date',
            'fecha_estimada_vuelta' => 'nullable|date|after:fecha_inicio',
            'estado'                => 'required|in:En tratamiento,Recuperado,Baja larga',
            'observaciones'         => 'nullable',
        ]);

        Lesion::create($data);
        return redirect()->route('lesiones.index')->with('success', 'Lesión registrada.');
    }

    public function edit(Lesion $lesion)
    {
        $jugadores = Jugador::where('activo', true)->orderBy('nombre')->get();
        return view('lesiones.form', compact('lesion', 'jugadores'));
    }

    public function update(Request $request, Lesion $lesion)
    {
        $data = $request->validate([
            'jugador_id'            => 'required|exists:jugadores,id',
            'tipo_lesion'           => 'required|max:120',
            'fecha_inicio'          => 'required|date',
            'fecha_estimada_vuelta' => 'nullable|date',
            'estado'                => 'required|in:En tratamiento,Recuperado,Baja larga',
            'observaciones'         => 'nullable',
        ]);

        $lesion->update($data);
        return redirect()->route('lesiones.index')->with('success', 'Lesión actualizada.');
    }

    public function destroy(Lesion $lesion)
    {
        $lesion->delete();
        return redirect()->route('lesiones.index')->with('success', 'Lesión eliminada.');
    }
}