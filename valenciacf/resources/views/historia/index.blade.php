@extends('layouts.app')
@section('content')

{{-- HERO HISTORIA --}}
<div class="hero-vcf p-5 mb-5 text-white">
    <div class="position-relative" style="z-index:2">
        <div class="d-flex align-items-center gap-3 mb-2">
            <img src="{{ asset('images/escudo.png') }}" style="height:60px;filter:drop-shadow(0 0 8px rgba(255,102,0,.6))"
                 alt="" onerror="this.style.display='none'">
            <div>
                <h1 class="fw-bold mb-0">Historia del Valencia CF</h1>
                <p class="mb-0" style="color:#FF6600">Fundado en 1919 · Más de 100 años de gloria</p>
            </div>
        </div>
    </div>
</div>

{{-- PALMARÉS --}}
<div class="row g-4 mb-5">
    <div class="col-12">
        <div class="d-flex align-items-center gap-3 mb-3">
            <h3 class="fw-bold mb-0">🏆 Palmarés oficial</h3>
            <div class="flex-grow-1 border-bottom" style="border-color:#FF6600 !important;border-width:2px !important"></div>
        </div>
    </div>
    @foreach($titulos as $t)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 card-jugador">
            <div class="card-body d-flex align-items-start gap-3">
                <div style="font-size:2.5rem;line-height:1">🏆</div>
                <div>
                    <h5 class="fw-bold mb-1" style="color:#FF6600">{{ $t->competicion }}</h5>
                    <div class="d-flex gap-2 mb-1 flex-wrap">
                        <span class="badge" style="background:#111">📅 {{ $t->anio }}</span>
                        @if($t->entrenador)
                        <span class="badge bg-light text-dark">👔 {{ $t->entrenador }}</span>
                        @endif
                    </div>
                    @if($t->descripcion)
                    <p class="text-muted small mb-0">{{ Str::limit($t->descripcion, 100) }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- TOP ESTADÍSTICAS TEMPORADA --}}
<div class="row g-4 mb-5">

    {{-- GOLEADORES --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header card-header-vcf-orange">⚽ Top goleadores 25/26</div>
            <div class="card-body p-0">
                @foreach($topGoleadores as $i => $r)
                <div class="d-flex align-items-center px-3 py-2 border-bottom">
                    <span class="fw-bold me-2" style="width:24px;color:#bbb">{{ $i+1 }}</span>
                    @if($r['jugador']->foto_url)
                        <img src="{{ asset('storage/'.$r['jugador']->foto_url) }}"
                             style="width:32px;height:32px;border-radius:50%;object-fit:cover;margin-right:8px">
                    @else
                        <div style="width:32px;height:32px;border-radius:50%;background:#FF6600;
                                    display:flex;align-items:center;justify-content:center;
                                    color:white;font-weight:700;font-size:.75rem;margin-right:8px">
                            {{ substr($r['jugador']->nombre, 0, 1) }}
                        </div>
                    @endif
                    <div class="flex-grow-1">
                        <a href="{{ route('jugadores.show', $r['jugador']) }}"
                           class="text-decoration-none fw-bold small text-dark">
                            {{ $r['jugador']->nombre }}
                        </a>
                        <div class="text-muted" style="font-size:.7rem">{{ $r['jugador']->posicion }}</div>
                    </div>
                    <span class="fw-bold fs-5" style="color:#FF6600">{{ $r['stats']['goles'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ASISTENTES --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header card-header-vcf-dark">🅰️ Top asistentes 25/26</div>
            <div class="card-body p-0">
                @foreach($topAsistentes as $i => $r)
                <div class="d-flex align-items-center px-3 py-2 border-bottom">
                    <span class="fw-bold me-2" style="width:24px;color:#bbb">{{ $i+1 }}</span>
                    @if($r['jugador']->foto_url)
                        <img src="{{ asset('storage/'.$r['jugador']->foto_url) }}"
                             style="width:32px;height:32px;border-radius:50%;object-fit:cover;margin-right:8px">
                    @else
                        <div style="width:32px;height:32px;border-radius:50%;background:#111;
                                    display:flex;align-items:center;justify-content:center;
                                    color:#FF6600;font-weight:700;font-size:.75rem;margin-right:8px">
                            {{ substr($r['jugador']->nombre, 0, 1) }}
                        </div>
                    @endif
                    <div class="flex-grow-1">
                        <a href="{{ route('jugadores.show', $r['jugador']) }}"
                           class="text-decoration-none fw-bold small text-dark">
                            {{ $r['jugador']->nombre }}
                        </a>
                        <div class="text-muted" style="font-size:.7rem">{{ $r['jugador']->posicion }}</div>
                    </div>
                    <span class="fw-bold fs-5" style="color:#111">{{ $r['stats']['asistencias'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- MÁS PARTIDOS --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header card-header-vcf-orange">🎮 Más partidos 25/26</div>
            <div class="card-body p-0">
                @foreach($topPartidos as $i => $r)
                <div class="d-flex align-items-center px-3 py-2 border-bottom">
                    <span class="fw-bold me-2" style="width:24px;color:#bbb">{{ $i+1 }}</span>
                    @if($r['jugador']->foto_url)
                        <img src="{{ asset('storage/'.$r['jugador']->foto_url) }}"
                             style="width:32px;height:32px;border-radius:50%;object-fit:cover;margin-right:8px">
                    @else
                        <div style="width:32px;height:32px;border-radius:50%;background:#FF6600;
                                    display:flex;align-items:center;justify-content:center;
                                    color:white;font-weight:700;font-size:.75rem;margin-right:8px">
                            {{ substr($r['jugador']->nombre, 0, 1) }}
                        </div>
                    @endif
                    <div class="flex-grow-1">
                        <a href="{{ route('jugadores.show', $r['jugador']) }}"
                           class="text-decoration-none fw-bold small text-dark">
                            {{ $r['jugador']->nombre }}
                        </a>
                        <div class="text-muted" style="font-size:.7rem">{{ $r['jugador']->posicion }}</div>
                    </div>
                    <span class="fw-bold fs-5" style="color:#FF6600">{{ $r['stats']['partidos_jugados'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

{{-- MVPs DE LA TEMPORADA --}}
@if($mvps->count())
<div class="card border-0 shadow-sm mb-5">
    <div class="card-header card-header-vcf-dark">⭐ MVPs de la temporada 25/26</div>
    <div class="card-body">
        <div class="row g-3">
            @foreach($mvps as $i => $m)
            <div class="col-md">
                <div class="card border-0 text-center shadow-sm"
                     style="border-top:3px solid {{ $i===0?'#FFD700':($i===1?'#C0C0C0':($i===2?'#CD7F32':'#FF6600')) }} !important">
                    <div class="card-body py-3">
                        <div style="font-size:1.8rem">
                            {{ $i===0?'🥇':($i===1?'🥈':($i===2?'🥉':'⭐')) }}
                        </div>
                        <div class="fw-bold mt-1">{{ $m['jugador']->nombre }}</div>
                        <div class="text-muted small">{{ $m['jugador']->posicion }}</div>
                        <div class="fw-bold mt-1" style="color:#FF6600;font-size:1.3rem">
                            {{ $m['total'] }} MVP{{ $m['total']>1?'s':'' }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@endsection