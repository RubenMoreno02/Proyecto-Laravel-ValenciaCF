@extends('layouts.app')
@section('content')

<h1 class="mb-1">Clasificación LaLiga 2025/26</h1>
<p class="text-muted mb-4">Posición del Valencia CF · Datos actualizados jornada a jornada</p>

{{-- RESUMEN --}}
<div class="row g-3 mb-5">
    @foreach([
        ['PJ','Partidos jugados',$pj,'#FF6600'],
        ['PTS','Puntos',$puntos,'#111111'],
        ['V','Victorias',$pg,'#22c55e'],
        ['E','Empates',$pe,'#f59e0b'],
        ['D','Derrotas',$pp,'#ef4444'],
        ['GF','Goles a favor',$gf,'#FF6600'],
        ['GC','Goles en contra',$gc,'#666'],
        ['DG','Diferencia',$gf-$gc,'#111'],
    ] as [$abr,$label,$val,$color])
    <div class="col-6 col-md-3 col-lg">
        <div class="card border-0 shadow-sm text-center h-100">
            <div class="card-body py-3">
                <div class="fw-bold fs-1" style="color:{{ $color }}">{{ $val }}</div>
                <div class="fw-bold" style="font-size:.8rem;color:#555;letter-spacing:.5px">{{ $abr }}</div>
                <div class="text-muted" style="font-size:.72rem">{{ $label }}</div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- GRÁFICA DE EVOLUCIÓN --}}
<div class="card border-0 shadow-sm mb-5">
    <div class="card-header card-header-vcf-dark">
        📈 Evolución de puntos — Jornada a jornada
    </div>
    <div class="card-body">
        <canvas id="graficaPuntos" height="100"></canvas>
    </div>
</div>

{{-- TABLA PARTIDO A PARTIDO --}}
<div class="card border-0 shadow-sm mb-5">
    <div class="card-header card-header-vcf-orange">📋 Resultados por jornada</div>
    <div class="card-body p-0">
        <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr><th>J.</th><th>Rival</th><th class="text-center">Marcador</th>
                    <th class="text-center">Resultado</th><th class="text-center">Puntos</th></tr>
            </thead>
            <tbody>
            @foreach($evolucion as $e)
            <tr>
                <td class="fw-bold text-muted">{{ $e['jornada'] }}</td>
                <td>{{ $e['rival'] }}</td>
                <td class="text-center fw-bold">{{ $e['marcador'] }}</td>
                <td class="text-center">
                    <span class="badge px-3 py-2 fs-6
                        {{ $e['resultado']==='V' ? 'bg-success' :
                           ($e['resultado']==='E' ? 'bg-warning text-dark' : 'bg-danger') }}">
                        {{ $e['resultado']==='V' ? '✓ Victoria' :
                           ($e['resultado']==='E' ? '= Empate' : '✗ Derrota') }}
                    </span>
                </td>
                <td class="text-center fw-bold fs-5" style="color:#FF6600">{{ $e['puntos'] }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>

{{-- ASISTENCIAS EN MESTALLA --}}
<div class="card border-0 shadow-sm">
    <div class="card-header card-header-vcf-dark">
        🏟️ Asistencia en Mestalla (capacidad: {{ number_format(49430,0,',','.') }} espectadores)
    </div>
    <div class="card-body p-0">
    <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
        <thead><tr><th>J.</th><th>Rival</th><th>Marcador</th><th>Espectadores</th><th>Ocupación</th></tr></thead>
        <tbody>
        @foreach($asistencias as $a)
        <tr>
            <td class="text-muted fw-bold">{{ $a['jornada'] }}</td>
            <td>{{ $a['rival'] }}</td>
            <td class="fw-bold">{{ $a['marcador'] }}</td>
            <td>{{ number_format($a['aforo'],0,',','.') }}</td>
            <td style="min-width:180px">
                <div class="d-flex align-items-center gap-2">
                    <div class="progress flex-grow-1" style="height:10px;border-radius:5px">
                        <div class="progress-bar"
                             style="width:{{ $a['porcentaje'] }}%;
                                    background:{{ $a['porcentaje']>90?'#22c55e':($a['porcentaje']>70?'#FF6600':'#f59e0b') }};
                                    border-radius:5px">
                        </div>
                    </div>
                    <span class="fw-bold small" style="min-width:45px">{{ $a['porcentaje'] }}%</span>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const labels = @json(collect($evolucion)->pluck('jornada'));
const puntos = @json(collect($evolucion)->pluck('puntos'));
const resultados = @json(collect($evolucion)->pluck('resultado'));
const rivales = @json(collect($evolucion)->pluck('rival'));
const marcadores = @json(collect($evolucion)->pluck('marcador'));

const pointColors = resultados.map(r =>
    r==='V' ? '#22c55e' : (r==='E' ? '#f59e0b' : '#ef4444')
);

new Chart(document.getElementById('graficaPuntos'), {
    type: 'line',
    data: {
        labels: labels.map(j => 'J'+j),
        datasets: [{
            label: 'Puntos acumulados',
            data: puntos,
            borderColor: '#FF6600',
            backgroundColor: 'rgba(255,102,0,.08)',
            borderWidth: 3,
            pointBackgroundColor: pointColors,
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 8,
            pointHoverRadius: 10,
            fill: true,
            tension: 0.3,
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    title: (items) => 'Jornada ' + labels[items[0].dataIndex],
                    afterTitle: (items) => rivales[items[0].dataIndex] + ' · ' + marcadores[items[0].dataIndex],
                    label: (item) => ' Puntos: ' + item.raw,
                    afterLabel: (item) => {
                        const r = resultados[item.dataIndex];
                        return r==='V'?' ✓ Victoria' : (r==='E'?' = Empate':' ✗ Derrota');
                    }
                },
                backgroundColor: '#111',
                titleColor: '#FF6600',
                bodyColor: '#fff',
                padding: 12,
                cornerRadius: 8,
            }
        },
        scales: {
            y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,.05)' } },
            x: { grid: { display: false } }
        }
    }
});
</script>
@endsection