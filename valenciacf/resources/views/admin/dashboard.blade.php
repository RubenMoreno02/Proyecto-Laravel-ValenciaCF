@extends('layouts.app')
@section('content')
<h1 class="mb-4">Panel de Administración</h1>

<div class="row row-cols-2 row-cols-md-4 g-3 mb-5">
    @foreach([
        ['Jugadores activos', $totalJugadores, '👤', route('jugadores.index')],
        ['Partidos', $totalPartidos, '⚽', route('partidos.index')],
        ['Lesiones activas', $lesionesActivas, '🏥', route('lesiones.index')],
        ['Usuarios', $totalUsuarios, '👥', '#'],
    ] as [$label, $val, $icon, $link])
    <div class="col">
        <a href="{{ $link }}" class="text-decoration-none">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <div style="font-size:2.5rem">{{ $icon }}</div>
                    <div class="fs-2 fw-bold" style="color:#FF6600">{{ $val }}</div>
                    <div class="text-muted">{{ $label }}</div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<div class="row g-3">
    <div class="col-md-3">
        <a href="{{ route('admin.jugadores.create') }}" class="btn btn-vcf w-100">➕ Nuevo jugador</a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.partidos.create') }}" class="btn btn-vcf w-100">➕ Nuevo partido</a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.lesiones.create') }}" class="btn btn-vcf w-100">➕ Nueva lesión</a>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.titulos.create') }}" class="btn btn-vcf w-100">➕ Nuevo título</a>
    </div>
</div>
@endsection