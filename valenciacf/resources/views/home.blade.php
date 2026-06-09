@extends('layouts.app')
@section('content')

{{-- HERO --}}
<div class="rounded-4 mb-5 p-5 text-white position-relative overflow-hidden"
     style="background: linear-gradient(135deg, #111111 60%, #FF6600); min-height:260px;">
    <div class="position-relative" style="z-index:2">
        <h1 class="display-4 fw-bold mb-1">Gestión Estadística</h1>
        <h2 class="fw-light mb-3" style="color:#FF6600;">Valencia CF · 2025/26</h2>
        <p class="lead mb-4 text-white-50">
            Consulta la plantilla, los partidos, las estadísticas y el palmarés del club.
        </p>
        <a href="{{ route('jugadores.index') }}" class="btn btn-vcf btn-lg me-2">Ver plantilla</a>
        <a href="{{ route('estadisticas.index') }}" class="btn btn-outline-light btn-lg">Estadísticas</a>
    </div>
    <div class="position-absolute top-0 end-0 p-4 opacity-10"
         style="font-size:12rem;line-height:1;z-index:1;">⚽</div>
</div>

{{-- TARJETAS DE ACCESO RÁPIDO --}}
<div class="row g-4 mb-5">
    @foreach([
        ['Plantilla',    'Consulta todos los jugadores del equipo.',           '👤', route('jugadores.index'),   '#FF6600'],
        ['Partidos',     'Resultados y estadísticas de cada encuentro.',        '🏟️', route('partidos.index'),    '#111111'],
        ['Estadísticas', 'Rankings de goleadores, asistentes y más.',          '📊', route('estadisticas.index'),'#FF6600'],
        ['Palmarés',     'Todos los títulos del Valencia CF.',                  '🏆', route('titulos.index'),     '#111111'],
        ['Lesiones',     'Estado médico actualizado de la plantilla.',          '🏥', route('lesiones.index'),    '#FF6600'],
    ] as [$titulo, $desc, $icon, $link, $color])
    <div class="col-6 col-md-4 col-lg">
        <a href="{{ $link }}" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 text-center card-jugador">
                <div class="card-body py-4">
                    <div style="font-size:2.5rem">{{ $icon }}</div>
                    <h5 class="fw-bold mt-2 mb-1" style="color:{{ $color }}">{{ $titulo }}</h5>
                    <p class="text-muted small mb-0">{{ $desc }}</p>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@php
    $ultimosPartidos = \App\Models\Partido::orderBy('fecha','desc')->take(5)->get();
    $lesionesActivas = \App\Models\Lesion::activas()->with('jugador')->take(4)->get();
@endphp

<div class="row g-4">

    {{-- ÚLTIMOS PARTIDOS --}}
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white fw-bold" style="background:#111111;">
                🕐 Últimos partidos
            </div>
            <div class="card-body p-0">
                @forelse($ultimosPartidos as $p)
                <div class="d-flex align-items-center justify-content-between px-3 py-2 border-bottom">
                    <div>
                        <span class="fw-bold">VCF vs {{ $p->rival }}</span>
                        <span class="badge bg-secondary ms-2" style="font-size:.7rem">{{ $p->competicion }}</span>
                        <div class="text-muted small">{{ $p->fecha->format('d/m/Y') }} · {{ $p->sede }}</div>
                    </div>
                    <div class="text-end">
                        <span class="fs-5 fw-bold
                            {{ $p->resultado === 'Victoria' ? 'text-success' :
                               ($p->resultado === 'Derrota'  ? 'text-danger' : 'text-warning') }}">
                            {{ $p->goles_favor }}–{{ $p->goles_contra }}
                        </span>
                        <div class="small text-muted">{{ $p->resultado }}</div>
                    </div>
                </div>
                @empty
                <p class="text-muted p-3 mb-0">Aún no hay partidos registrados.</p>
                @endforelse
            </div>
            <div class="card-footer bg-white text-end">
                <a href="{{ route('partidos.index') }}" class="btn btn-sm btn-vcf">Ver todos</a>
            </div>
        </div>
    </div>

    {{-- LESIONES ACTIVAS --}}
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-header text-white fw-bold" style="background:#FF6600;">
                🏥 Lesiones activas
            </div>
            <div class="card-body p-0">
                @forelse($lesionesActivas as $l)
                <div class="d-flex align-items-center px-3 py-2 border-bottom">
                    <div>
                        <div class="fw-bold">{{ $l->jugador->nombre }}</div>
                        <div class="text-muted small">{{ $l->tipo_lesion }}</div>
                    </div>
                    <span class="ms-auto badge {{ $l->estado === 'Baja larga' ? 'bg-danger' : 'bg-warning text-dark' }}">
                        {{ $l->estado }}
                    </span>
                </div>
                @empty
                <p class="text-muted p-3 mb-0">🎉 No hay lesiones activas.</p>
                @endforelse
            </div>
            <div class="card-footer bg-white text-end">
                <a href="{{ route('lesiones.index') }}" class="btn btn-sm btn-vcf">Ver todas</a>
            </div>
        </div>
    </div>

</div>
@endsection