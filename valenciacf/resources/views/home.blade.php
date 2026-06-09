@extends('layouts.app')
@section('content')

{{-- HERO --}}
<div class="hero-vcf p-5 mb-5 text-white">
    <div class="row align-items-center position-relative" style="z-index:2">
        <div class="col-md-8">
            <div class="d-flex align-items-center gap-3 mb-3">
                <img src="{{ asset('images/escudo.png') }}" style="height:70px;filter:drop-shadow(0 0 12px rgba(255,102,0,.5))"
                     alt="VCF" onerror="this.style.display='none'">
                <div>
                    <h1 class="display-5 fw-bold mb-0">Gestión Estadística</h1>
                    <h2 class="fw-light mb-0" style="color:var(--vcf-naranja)">Valencia CF · 2025/26</h2>
                </div>
            </div>
            <p class="text-white-50 mb-4" style="font-size:1.1rem">
                Plataforma oficial de estadísticas, plantilla y seguimiento deportivo del equipo.
            </p>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('jugadores.index') }}" class="btn btn-vcf btn-lg px-4">👤 Ver plantilla</a>
                <a href="{{ route('estadisticas.index') }}" class="btn btn-outline-light btn-lg px-4">📊 Estadísticas</a>
            </div>
        </div>
        <div class="col-md-4 text-center d-none d-md-block">
            <img src="{{ asset('images/escudo.png') }}"
                 style="height:200px;opacity:.15;filter:blur(1px)" alt=""
                 onerror="this.style.display='none'">
        </div>
    </div>
</div>

{{-- TARJETAS DE ACCESO RÁPIDO --}}
<div class="row g-3 mb-5">
    @foreach([
        ['Plantilla',    '👤', route('jugadores.index'),   'Jugadores del equipo'],
        ['Partidos',     '🏟️', route('partidos.index'),    'Resultados temporada'],
        ['Estadísticas', '📊', route('estadisticas.index'),'Rankings y comparativas'],
        ['Palmarés',     '🏆', route('titulos.index'),     'Historia del club'],
        ['Lesiones',     '🏥', route('lesiones.index'),    'Estado médico'],
    ] as [$titulo, $icon, $link, $desc])
    <div class="col-6 col-md">
        <a href="{{ $link }}" class="text-decoration-none">
            <div class="card h-100 shadow-sm border-0 text-center card-jugador">
                <div class="card-body py-4">
                    <div style="font-size:2rem">{{ $icon }}</div>
                    <div class="fw-bold mt-2" style="color:var(--vcf-naranja)">{{ $titulo }}</div>
                    <div class="text-muted" style="font-size:.78rem">{{ $desc }}</div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@php
    $ultimosPartidos = \App\Models\Partido::orderBy('fecha','desc')->take(5)->get();
    $lesionesActivas = \App\Models\Lesion::activas()->with('jugador')->take(4)->get();
    $goleadores = \App\Models\Jugador::where('activo',true)->get()
        ->map(fn($j) => array_merge(['jugador'=>$j], calcularEstadisticasTemporada($j->id)))
        ->sortByDesc('goles')->take(5)->values();
@endphp

<div class="row g-4">

    {{-- ÚLTIMOS PARTIDOS --}}
    <div class="col-lg-5">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header card-header-vcf-dark">🕐 Últimos resultados</div>
            <div class="card-body p-0">
                @forelse($ultimosPartidos as $p)
                <div class="d-flex align-items-center px-3 py-2 border-bottom">
                    <div class="flex-grow-1">
                        <div class="fw-bold small">VCF vs {{ $p->rival }}</div>
                        <div class="text-muted" style="font-size:.72rem">
                            {{ $p->fecha->format('d/m/Y') }} · {{ $p->competicion }}
                        </div>
                    </div>
                    <div class="text-end">
                        <span class="fw-bold
                            {{ $p->resultado==='Victoria' ? 'result-victoria' :
                               ($p->resultado==='Derrota' ? 'result-derrota' : 'result-empate') }}">
                            {{ $p->goles_favor }}–{{ $p->goles_contra }}
                        </span>
                    </div>
                </div>
                @empty
                <p class="text-muted p-3 mb-0 small">Sin partidos registrados.</p>
                @endforelse
            </div>
            <div class="card-footer bg-white border-0 text-end">
                <a href="{{ route('partidos.index') }}" class="btn btn-sm btn-vcf">Ver todos →</a>
            </div>
        </div>
    </div>

    {{-- TOP GOLEADORES --}}
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header card-header-vcf-orange">⚽ Top goleadores</div>
            <div class="card-body p-0">
                @forelse($goleadores->filter(fn($r) => $r['goles'] > 0) as $i => $r)
                <div class="d-flex align-items-center px-3 py-2 border-bottom">
                    <span class="fw-bold me-2 text-muted" style="width:20px">{{ $i+1 }}</span>
                    <div class="flex-grow-1">
                        <a href="{{ route('jugadores.show', $r['jugador']) }}"
                           class="text-decoration-none fw-bold small text-dark">
                            {{ $r['jugador']->nombre }}
                        </a>
                        <div class="text-muted" style="font-size:.7rem">{{ $r['jugador']->posicion }}</div>
                    </div>
                    <span class="fw-bold" style="color:var(--vcf-naranja);font-size:1.1rem">
                        {{ $r['goles'] }}
                    </span>
                </div>
                @empty
                <p class="text-muted p-3 mb-0 small">Sin goles registrados aún.</p>
                @endforelse
            </div>
            <div class="card-footer bg-white border-0 text-end">
                <a href="{{ route('estadisticas.index') }}" class="btn btn-sm btn-vcf">Ver ranking →</a>
            </div>
        </div>
    </div>

    {{-- LESIONES --}}
    <div class="col-lg-3">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header card-header-vcf-dark">🏥 Bajas médicas</div>
            <div class="card-body p-0">
                @forelse($lesionesActivas as $l)
                <div class="px-3 py-2 border-bottom">
                    <div class="fw-bold small">{{ $l->jugador->nombre }}</div>
                    <div class="d-flex align-items-center justify-content-between mt-1">
                        <span class="text-muted" style="font-size:.7rem">{{ Str::limit($l->tipo_lesion, 22) }}</span>
                        <span class="badge {{ $l->estado==='Baja larga' ? 'bg-danger' : 'bg-warning text-dark' }}"
                              style="font-size:.65rem">{{ $l->estado }}</span>
                    </div>
                </div>
                @empty
                <div class="text-center py-4">
                    <div style="font-size:2rem">🎉</div>
                    <p class="text-muted small mb-0">Sin lesiones activas</p>
                </div>
                @endforelse
            </div>
            <div class="card-footer bg-white border-0 text-end">
                <a href="{{ route('lesiones.index') }}" class="btn btn-sm btn-vcf">Ver todas →</a>
            </div>
        </div>
    </div>

</div>
@endsection