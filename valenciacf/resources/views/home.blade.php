@extends('layouts.app')
@section('content')

@php
    use App\Models\Partido;
    use App\Models\Lesion;
    use App\Models\Jugador;
    use App\Models\Titulo;

    $ultimosPartidos = Partido::orderBy('fecha','desc')->take(5)->get();
    $lesionesActivas = Lesion::activas()->with('jugador')->take(3)->get();

    // Clasificación (puntos acumulados Liga)
    $partidosLiga = Partido::where('competicion','Liga')->orderBy('jornada')->get();
    $puntos = 0; $pg = 0; $pe = 0; $pp = 0; $gf = 0; $gc = 0;
    foreach ($partidosLiga as $p) {
        $gf += $p->goles_favor; $gc += $p->goles_contra;
        if ($p->goles_favor > $p->goles_contra)      { $pg++; $puntos += 3; }
        elseif ($p->goles_favor === $p->goles_contra) { $pe++; $puntos += 1; }
        else                                           { $pp++; }
    }
    $pj = $pg + $pe + $pp;

    // Top goleadores
    $jugadores = Jugador::where('activo', true)->get();
    $goleadores = $jugadores->map(fn($j) => [
        'jugador' => $j,
        'stats'   => calcularEstadisticasTemporada($j->id)
    ])->sortByDesc('stats.goles')->take(5)->values();

    // Noticias recientes (3 últimas)
    $noticiasRecientes = collect([
        ['titulo' => 'Hugo Duro renueva hasta 2028',            'categoria' => 'Club',    'fecha' => '2026-02-10', 'img' => 'https://placehold.co/400x220/1a1a1a/FF6600?text=Hugo+Duro'],
        ['titulo' => 'Pepelu, nominado al Once de la semana',   'categoria' => 'LaLiga',  'fecha' => '2026-02-03', 'img' => 'https://placehold.co/400x220/FF6600/ffffff?text=Pepelu'],
        ['titulo' => 'El VCF alcanza los 50 puntos en Liga',    'categoria' => 'LaLiga',  'fecha' => '2026-04-06', 'img' => 'https://placehold.co/400x220/1a1a1a/ffffff?text=50+Puntos'],
    ]);
@endphp

{{-- ── HERO ── --}}
<div class="hero-vcf p-4 p-md-5 mb-5 text-white">
  <div class="row align-items-center" style="position:relative;z-index:2">
    <div class="col-md-7">
      <div class="d-flex align-items-center gap-3 mb-3">
        <img src="{{ asset('images/escudo.png') }}" style="height:65px;filter:drop-shadow(0 0 10px rgba(255,102,0,.5))"
             alt="VCF" onerror="this.style.display='none'">
        <div>
          <h1 class="fw-bold mb-0" style="font-size:clamp(1.6rem,4vw,2.4rem)">Gestión Estadística</h1>
          <p class="mb-0 fw-light" style="color:var(--vcf-naranja);font-size:1.05rem">Valencia CF · Temporada 2025/26</p>
        </div>
      </div>
      <p style="color:rgba(255,255,255,.55);max-width:480px" class="mb-4">
        Plataforma oficial de estadísticas, plantilla, clasificación y noticias del Valencia CF.
      </p>
      <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('jugadores.index') }}"     class="btn btn-vcf px-4">👤 Plantilla</a>
        <a href="{{ route('estadisticas.index') }}"  class="btn btn-outline-vcf px-4">📊 Estadísticas</a>
        <a href="{{ route('clasificacion.index') }}" class="btn btn-outline-light px-4">📈 Clasificación</a>
      </div>
    </div>
    <div class="col-md-5 text-center d-none d-md-block">
      <img src="{{ asset('images/escudo.png') }}" style="height:190px;opacity:.08" alt=""
           onerror="this.style.display='none'">
    </div>
  </div>
</div>

{{-- ── ACCESOS RÁPIDOS ── --}}
<div class="row g-3 mb-5">
  @foreach([
    ['👤','Plantilla',    'Jugadores del equipo',          route('jugadores.index')],
    ['🏟️','Partidos',     'Resultados temporada',           route('partidos.index')],
    ['📊','Estadísticas', 'Rankings y datos',               route('estadisticas.index')],
    ['⚖️','Comparador',   'Compara dos jugadores',          route('estadisticas.comparar')],
    ['📈','Clasificación','Evolución de puntos',            route('clasificacion.index')],
    ['📰','Noticias',     'Actualidad del club',            route('noticias.index')],
    ['🏆','Palmarés',     'Historia y títulos',             route('titulos.index')],
    ['📖','Historia',     'Top jugadores y rankings',       route('historia.index')],
    ['🏥','Lesiones',     'Estado médico de la plantilla',  route('lesiones.index')],
  ] as [$icon,$title,$desc,$link])
  <div class="col-6 col-sm-4 col-md-3 col-lg">
    <a href="{{ $link }}" class="text-decoration-none">
      <div class="card border-0 shadow-sm text-center card-jugador h-100">
        <div class="card-body py-3 px-2">
          <div style="font-size:1.7rem">{{ $icon }}</div>
          <div class="fw-bold mt-1" style="color:var(--vcf-naranja);font-size:.85rem">{{ $title }}</div>
          <div class="text-muted" style="font-size:.72rem">{{ $desc }}</div>
        </div>
      </div>
    </a>
  </div>
  @endforeach
</div>

{{-- ── BLOQUE CENTRAL: Últimos resultados + Clasificación + Top goleadores ── --}}
<div class="row g-4 mb-5">

  {{-- ÚLTIMOS RESULTADOS --}}
  <div class="col-lg-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header-dark d-flex justify-content-between align-items-center">
        <span>🕐 Últimos resultados</span>
        <a href="{{ route('partidos.index') }}" style="color:var(--vcf-naranja);font-size:.8rem;text-decoration:none">Ver todos →</a>
      </div>
      <div class="card-body p-0">
        @forelse($ultimosPartidos as $p)
        <div class="d-flex align-items-center px-3 py-2 border-bottom">
          <div class="flex-grow-1">
            <div class="fw-bold" style="font-size:.88rem">VCF vs {{ $p->rival }}</div>
            <div class="text-muted" style="font-size:.72rem">
              {{ $p->fecha->format('d/m/Y') }} · <span class="badge bg-light text-dark" style="font-size:.65rem">{{ $p->competicion }}</span>
            </div>
          </div>
          <div class="text-end ms-2">
            <div class="fw-bold result-{{ $p->resultado==='Victoria'?'V':($p->resultado==='Derrota'?'D':'E') }}" style="font-size:1rem">
              {{ $p->goles_favor }}–{{ $p->goles_contra }}
            </div>
            <div style="font-size:.7rem;color:#999">{{ $p->resultado }}</div>
          </div>
        </div>
        @empty
        <p class="text-muted p-3 small mb-0">Sin partidos registrados.</p>
        @endforelse
      </div>
    </div>
  </div>

  {{-- RESUMEN CLASIFICACIÓN --}}
  <div class="col-lg-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header-orange d-flex justify-content-between align-items-center">
        <span>📈 Clasificación LaLiga</span>
        <a href="{{ route('clasificacion.index') }}" style="color:rgba(255,255,255,.8);font-size:.8rem;text-decoration:none">Detalle →</a>
      </div>
      <div class="card-body">

        {{-- Puntos grandes --}}
        <div class="text-center py-2 mb-3">
          <div style="font-size:3.5rem;font-weight:800;color:var(--vcf-naranja);line-height:1">{{ $puntos }}</div>
          <div class="text-muted small">puntos · {{ $pj }} partidos jugados</div>
        </div>

        {{-- Mini barra de racha (últimos 5) --}}
        <div class="d-flex justify-content-center gap-1 mb-3">
          @foreach($ultimosPartidos->take(5)->reverse() as $p)
            @php $r = $p->resultado==='Victoria'?'V':($p->resultado==='Derrota'?'D':'E'); @endphp
            <div title="{{ $p->rival }} {{ $p->goles_favor }}-{{ $p->goles_contra }}"
                 style="width:32px;height:32px;border-radius:50%;font-weight:700;font-size:.8rem;
                        display:flex;align-items:center;justify-content:center;color:white;
                        background:{{ $r==='V'?'#22c55e':($r==='D'?'#ef4444':'#f59e0b') }}">
              {{ $r }}
            </div>
          @endforeach
        </div>
        <div class="text-center text-muted" style="font-size:.7rem" class="mb-3">Últimos 5 resultados</div>

        {{-- Stats --}}
        <div class="row g-2 mt-2 text-center">
          @foreach([['V',$pg,'#22c55e'],['E',$pe,'#f59e0b'],['D',$pp,'#ef4444'],['GF',$gf,'#FF6600'],['GC',$gc,'#666']] as [$l,$v,$c])
          <div class="col">
            <div class="fw-bold fs-5" style="color:{{ $c }}">{{ $v }}</div>
            <div class="text-muted" style="font-size:.7rem">{{ $l }}</div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>

  {{-- TOP GOLEADORES --}}
  <div class="col-lg-4">
    <div class="card border-0 shadow-sm h-100">
      <div class="card-header-dark d-flex justify-content-between align-items-center">
        <span>⚽ Top goleadores</span>
        <a href="{{ route('estadisticas.index') }}" style="color:var(--vcf-naranja);font-size:.8rem;text-decoration:none">Ver ranking →</a>
      </div>
      <div class="card-body p-0">
        @forelse($goleadores->filter(fn($r)=>$r['stats']['goles']>0) as $i => $r)
        <div class="d-flex align-items-center px-3 py-2 border-bottom">
          <span class="fw-bold me-2 text-muted" style="width:20px;font-size:.85rem">{{ $i+1 }}</span>
          @if($r['jugador']->foto_url)
            <img src="{{ asset('storage/'.$r['jugador']->foto_url) }}"
                 style="width:34px;height:34px;border-radius:50%;object-fit:cover;margin-right:10px">
          @else
            <div style="width:34px;height:34px;border-radius:50%;background:var(--vcf-naranja);
                        display:flex;align-items:center;justify-content:center;
                        color:#fff;font-weight:700;font-size:.8rem;margin-right:10px">
              {{ strtoupper(substr($r['jugador']->nombre,0,1)) }}
            </div>
          @endif
          <div class="flex-grow-1">
            <a href="{{ route('jugadores.show', $r['jugador']) }}"
               class="text-decoration-none fw-bold text-dark" style="font-size:.88rem">
              {{ $r['jugador']->nombre }}
            </a>
            <div class="text-muted" style="font-size:.7rem">{{ $r['jugador']->posicion }}</div>
          </div>
          <span class="fw-bold fs-5" style="color:var(--vcf-naranja)">{{ $r['stats']['goles'] }}</span>
        </div>
        @empty
        <p class="text-muted p-3 small mb-0">Sin goles registrados aún.</p>
        @endforelse
      </div>
    </div>
  </div>

</div>

{{-- ── NOTICIAS + LESIONES ── --}}
<div class="row g-4 mb-5">

  {{-- NOTICIAS --}}
  <div class="col-lg-8">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h4 class="fw-bold mb-0">📰 Últimas noticias</h4>
      <a href="{{ route('noticias.index') }}" class="btn btn-sm btn-vcf">Ver todas</a>
    </div>
    <div class="row g-3">
      @foreach($noticiasRecientes as $n)
      <div class="col-md-4">
        <a href="{{ route('noticias.index') }}" class="text-decoration-none">
          <div class="card border-0 shadow-sm h-100 card-jugador overflow-hidden">
            <img src="{{ $n['img'] }}" alt="{{ $n['titulo'] }}"
                 style="height:140px;object-fit:cover;width:100%"
                 onerror="this.style.background='#1a1a1a';this.removeAttribute('src')">
            <div class="card-body p-3">
              <span class="badge mb-2" style="background:var(--vcf-naranja);font-size:.68rem">{{ $n['categoria'] }}</span>
              <p class="fw-bold mb-1 text-dark" style="font-size:.88rem;line-height:1.35">{{ $n['titulo'] }}</p>
              <p class="text-muted mb-0" style="font-size:.75rem">
                {{ \Carbon\Carbon::parse($n['fecha'])->format('d M Y') }}
              </p>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>

  {{-- LESIONES ACTIVAS --}}
  <div class="col-lg-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h4 class="fw-bold mb-0">🏥 Bajas médicas</h4>
      <a href="{{ route('lesiones.index') }}" class="btn btn-sm btn-vcf">Ver todas</a>
    </div>
    <div class="card border-0 shadow-sm">
      <div class="card-body p-0">
        @forelse($lesionesActivas as $l)
        <div class="px-3 py-3 border-bottom">
          <div class="d-flex align-items-start justify-content-between">
            <div class="fw-bold" style="font-size:.9rem">{{ $l->jugador->nombre }}</div>
            <span class="badge ms-2 {{ $l->estado==='Baja larga'?'bg-danger':'bg-warning text-dark' }}" style="font-size:.68rem;white-space:nowrap">
              {{ $l->estado }}
            </span>
          </div>
          <div class="text-muted mt-1" style="font-size:.8rem">
            🦴 {{ $l->tipo_lesion }}
            @if($l->parte_cuerpo ?? null)
              · <em>{{ $l->parte_cuerpo }}</em>
            @endif
          </div>
          @if($l->fecha_estimada_vuelta)
          <div class="mt-1" style="font-size:.78rem">
            @php
              $dias = now()->diffInDays(\Carbon\Carbon::parse($l->fecha_estimada_vuelta), false);
            @endphp
            @if($dias > 0)
              ⏳ <strong>{{ $dias }} días</strong> para la vuelta estimada
            @else
              ✅ Vuelta estimada superada
            @endif
          </div>
          @endif
        </div>
        @empty
        <div class="text-center py-4">
          <div style="font-size:2.5rem">🎉</div>
          <p class="text-muted small mt-2 mb-0">¡Sin lesiones activas!</p>
        </div>
        @endforelse
      </div>
    </div>
  </div>

</div>

{{-- ── COMPARADOR RÁPIDO ── --}}
<div class="card border-0 shadow-sm mb-5" style="border-left:4px solid var(--vcf-naranja) !important">
  <div class="card-body d-flex flex-column flex-md-row align-items-center gap-4 py-4">
    <div style="font-size:3rem">⚖️</div>
    <div class="flex-grow-1">
      <h5 class="fw-bold mb-1">Comparador de jugadores</h5>
      <p class="text-muted mb-0" style="font-size:.9rem">
        Compara las estadísticas de dos jugadores de la temporada 2025/26: goles, asistencias, minutos, tarjetas y más.
      </p>
    </div>
    <a href="{{ route('estadisticas.comparar') }}" class="btn btn-vcf px-4 py-2 fw-bold flex-shrink-0">
      Ir al comparador →
    </a>
  </div>
</div>

{{-- ── PALMARÉS RÁPIDO ── --}}
@php
  $titulosCount = \App\Models\Titulo::count();
  $ligas = \App\Models\Titulo::where('competicion','Liga Española')->count();
  $copas = \App\Models\Titulo::where('competicion','Copa del Rey')->count();
  $europeos = \App\Models\Titulo::whereIn('competicion',['UEFA','Champions League','Recopa de Europa'])->count();
@endphp
<div class="card border-0 shadow-sm mb-5" style="background:linear-gradient(135deg,#0d0d0d,#1c1200);border:1px solid rgba(255,102,0,.2) !important">
  <div class="card-body py-4">
    <div class="row align-items-center text-center g-3">
      <div class="col-12 col-md-3 text-md-start mb-2 mb-md-0">
        <h5 class="fw-bold text-white mb-0">🏆 Palmarés del club</h5>
        <p style="color:#666;font-size:.82rem" class="mb-0">{{ $titulosCount }} títulos registrados</p>
      </div>
      @foreach([
        [$ligas,   'Ligas',          '#FFD700'],
        [$copas,   'Copas del Rey',  '#FF6600'],
        [$europeos,'Títulos Europeos','#60a5fa'],
      ] as [$n,$l,$c])
      <div class="col-4 col-md">
        <div class="fw-bold" style="font-size:2.2rem;color:{{ $c }}">{{ $n }}</div>
        <div style="color:#666;font-size:.8rem">{{ $l }}</div>
      </div>
      @endforeach
      <div class="col-12 col-md-auto mt-2 mt-md-0">
        <a href="{{ route('titulos.index') }}" class="btn btn-vcf px-4">Ver palmarés →</a>
      </div>
    </div>
  </div>
</div>

@endsection