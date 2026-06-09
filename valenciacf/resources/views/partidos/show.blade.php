@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <a href="{{ route('partidos.index') }}" class="text-muted text-decoration-none small">← Volver a partidos</a>
        <h1 class="mt-1">VCF vs {{ $partido->rival }}</h1>
        <span class="badge bg-secondary">{{ $partido->competicion }}</span>
        @if($partido->jornada)
            <span class="badge bg-light text-dark ms-1">Jornada {{ $partido->jornada }}</span>
        @endif
        <span class="badge bg-light text-dark ms-1">{{ $partido->sede }}</span>
        @if($partido->estadio)
            <span class="text-muted small ms-2">📍 {{ $partido->estadio }}</span>
        @endif
    </div>
    @auth @if(auth()->user()->rol === 'admin')
    <div class="d-flex gap-2">
        <a href="{{ route('admin.partidos.edit', $partido) }}" class="btn btn-vcf btn-sm">Editar</a>
        <form method="POST" action="{{ route('admin.partidos.destroy', $partido) }}"
              onsubmit="return confirm('¿Eliminar este partido y sus estadísticas?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger btn-sm">Eliminar</button>
        </form>
    </div>
    @endif @endauth
</div>

{{-- MARCADOR --}}
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body text-center py-4">
        <div class="row align-items-center">
            <div class="col text-end">
                <div class="fw-bold fs-4">Valencia CF</div>
                <div class="text-muted small">{{ $partido->sede === 'Local' ? 'Local' : 'Visitante' }}</div>
            </div>
            <div class="col-auto px-4">
                <div class="display-3 fw-bold"
                     style="color:{{ $partido->resultado === 'Victoria' ? '#198754' :
                                     ($partido->resultado === 'Derrota' ? '#dc3545' : '#fd7e14') }}">
                    {{ $partido->goles_favor }} – {{ $partido->goles_contra }}
                </div>
                <div class="badge fs-6
                    {{ $partido->resultado === 'Victoria' ? 'bg-success' :
                       ($partido->resultado === 'Derrota' ? 'bg-danger' : 'bg-warning text-dark') }}">
                    {{ $partido->resultado }}
                </div>
                <div class="text-muted small mt-1">{{ $partido->fecha->format('d \d\e F \d\e Y') }}</div>
            </div>
            <div class="col text-start">
                <div class="fw-bold fs-4">{{ $partido->rival }}</div>
                <div class="text-muted small">{{ $partido->sede === 'Visitante' ? 'Local' : 'Visitante' }}</div>
            </div>
        </div>
    </div>
</div>

{{-- ESTADÍSTICAS INDIVIDUALES --}}
<h4 class="mb-3">Estadísticas individuales</h4>
@if($estadisticas->count())
<div class="table-responsive">
<table class="table table-striped table-hover align-middle">
    <thead>
        <tr>
            <th>Jugador</th>
            <th class="text-center">Titular</th>
            <th class="text-center">Min</th>
            <th class="text-center">⚽</th>
            <th class="text-center">🅰️</th>
            <th class="text-center">🟨</th>
            <th class="text-center">🟥</th>
            <th class="text-center">Faltas C.</th>
            <th class="text-center">Faltas R.</th>
        </tr>
    </thead>
    <tbody>
    @foreach($estadisticas->sortByDesc('titular') as $e)
    <tr>
        <td>
            <a href="{{ route('jugadores.show', $e->jugador) }}" class="text-decoration-none fw-bold">
                <span class="badge-dorsal me-1">{{ $e->jugador->dorsal }}</span>
                {{ $e->jugador->nombre }}
            </a>
            <span class="badge bg-light text-dark ms-1 small">{{ $e->jugador->posicion }}</span>
        </td>
        <td class="text-center">{{ $e->titular ? '✅' : '🔄' }}</td>
        <td class="text-center">{{ $e->minutos_jugados }}'</td>
        <td class="text-center fw-bold {{ $e->goles > 0 ? 'text-success' : '' }}">{{ $e->goles ?: '–' }}</td>
        <td class="text-center fw-bold {{ $e->asistencias > 0 ? 'text-primary' : '' }}">{{ $e->asistencias ?: '–' }}</td>
        <td class="text-center">{{ $e->amarillas ?: '–' }}</td>
        <td class="text-center">{{ $e->rojas ?: '–' }}</td>
        <td class="text-center">{{ $e->faltas_cometidas ?: '–' }}</td>
        <td class="text-center">{{ $e->faltas_recibidas ?: '–' }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
@else
    <p class="text-muted">No hay estadísticas individuales registradas para este partido.</p>
@endif
@endsection