<?php
namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Partido;
use App\Models\Lesion;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalJugadores  = Jugador::where('activo', true)->count();
        $totalPartidos   = Partido::count();
        $lesionesActivas = Lesion::activas()->count();
        $totalUsuarios   = User::count();

        return view('admin.dashboard', compact(
            'totalJugadores', 'totalPartidos', 'lesionesActivas', 'totalUsuarios'
        ));
    }
}