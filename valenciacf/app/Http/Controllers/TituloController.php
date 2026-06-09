<?php
namespace App\Http\Controllers;

use App\Models\Titulo;
use Illuminate\Http\Request;

class TituloController extends Controller
{
    public function index()
    {
        $titulos = Titulo::orderBy('anio', 'desc')->paginate(15);
        return view('titulos.index', compact('titulos'));
    }

    public function show(Titulo $titulo)
    {
        return view('titulos.show', compact('titulo'));
    }

    public function create()
    {
        return view('titulos.form', ['titulo' => new Titulo()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'competicion' => 'required|max:100',
            'anio'        => 'required|integer|min:1900|max:2100',
            'descripcion' => 'nullable',
            'entrenador'  => 'nullable|max:100',
        ]);

        Titulo::create($data);
        return redirect()->route('titulos.index')->with('success', 'Título añadido al palmarés.');
    }

    public function edit(Titulo $titulo)
    {
        return view('titulos.form', compact('titulo'));
    }

    public function update(Request $request, Titulo $titulo)
    {
        $data = $request->validate([
            'competicion' => 'required|max:100',
            'anio'        => 'required|integer|min:1900|max:2100',
            'descripcion' => 'nullable',
            'entrenador'  => 'nullable|max:100',
        ]);

        $titulo->update($data);
        return redirect()->route('titulos.index')->with('success', 'Título actualizado.');
    }

    public function destroy(Titulo $titulo)
    {
        $titulo->delete();
        return redirect()->route('titulos.index')->with('success', 'Título eliminado.');
    }
}