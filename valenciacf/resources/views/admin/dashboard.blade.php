@extends('layouts.app')
@section('content')

<div class="d-flex align-items-center mb-4">
    <div>
        <h1 class="mb-0">Panel de Administración</h1>
        <p class="text-muted mb-0">Bienvenido, {{ auth()->user()->name }}</p>
    </div>
</div>

{{-- CONTADORES --}}
<div class="row g-3 mb-5">
    @foreach([
        ['Jugadores activos', $totalJugadores,  '👤', route('jugadores.index'),   '#FF6600'],
        ['Partidos',          $totalPartidos,   '🏟️', route('partidos.index'),    '#111111'],
        ['Lesiones activas',  $lesionesActivas, '🏥', route('lesiones.index'),   '#FF6600'],
        ['Usuarios',          $totalUsuarios,   '👥', '#',                        '#111111'],
    ] as [$label, $val, $icon, $link, $color])
    <div class="col-6 col-md-3">
        <a href="{{ $link }}" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 text-center card-jugador">
                <div class="card-body py-4">
                    <div style="font-size:2.5rem">{{ $icon }}</div>
                    <div class="fs-1 fw-bold" style="color:{{ $color }}">{{ $val }}</div>
                    <div class="text-muted small">{{ $label }}</div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

{{-- ACCIONES RÁPIDAS --}}
<h5 class="fw-bold mb-3">Acciones rápidas</h5>
<div class="row g-3">
    @foreach([
        ['➕ Nuevo jugador', route('admin.jugadores.create')],
        ['➕ Nuevo partido', route('admin.partidos.create')],
        ['➕ Nueva lesión',  route('admin.lesiones.create')],
        ['➕ Nuevo título',  route('admin.titulos.create')],
    ] as [$label, $link])
    <div class="col-6 col-md-3">
        <a href="{{ $link }}" class="btn btn-vcf w-100 py-3 fw-bold">{{ $label }}</a>
    </div>
    @endforeach
</div>

@endsection