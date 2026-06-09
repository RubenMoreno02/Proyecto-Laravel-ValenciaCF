@extends('layouts.app')
@section('content')

<h1 class="mb-4">Comparativa de jugadores</h1>

<form method="GET" class="card shadow-sm border-0 p-4 mb-4">
    <div class="row g-3 align-items-end">
        <div class="col-md-5">
            <label class="form-label fw-bold">Jugador A</label>
            <select name="jugador_a" class="form-select" required>
                <option value="">Selecciona jugador...</option>
                @foreach($jugadores as $j)
                    <option value="{{ $j->id }}" {{ request('jugador_a') == $j->id ? 'selected' : '' }}>
                        {{ $j->dorsal }}. {{ $j->nombre }} ({{ $j->posicion }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1 text-center">
            <span class="fw-bold fs-4 text-muted">VS</span>
        </div>
        <div class="col-md-5">
            <label class="form-label fw-bold">Jugador B</label>
            <select name="jugador_b" class="form-select" required>
                <option value="">Selecciona jugador...</option>
                @foreach($jugadores as $j)
                    <option value="{{ $j->id }}" {{ request('jugador_b') == $j->id ? 'selected' : '' }}>
                        {{ $j->dorsal }}. {{ $j->nombre }} ({{ $j->posicion }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-vcf w-100">Comparar</button>
        </div>
    </div>
</form>

@if($statsA && $statsB)
<div class="card shadow-sm border-0">
<div class="card-body">

<div class="row text-center mb-4">
    <div class="col">
        <h4 class="fw-bold" style="color:#FF6600">{{ $jugadorA->nombre }}</h4>
        <span class="badge bg-light text-dark">{{ $jugadorA->posicion }}</span>
    </div>
    <div class="col-auto d-flex align-items-center">
        <span class="fw-bold text-muted fs-4">VS</span>
    </div>
    <div class="col">
        <h4 class="fw-bold" style="color:#111111">{{ $jugadorB->nombre }}</h4>
        <span class="badge bg-light text-dark">{{ $jugadorB->posicion }}</span>
    </div>
</div>

@php
$filas = [
    ['⚽ Goles',             'goles'],
    ['🅰️ Asistencias',       'asistencias'],
    ['⏱️ Minutos',           'minutos_totales'],
    ['🎮 Partidos',          'partidos_jugados'],
    ['🟨 Amarillas',         'amarillas'],
    ['🟥 Rojas',             'rojas'],
    ['Faltas cometidas',     'faltas_cometidas'],
    ['Faltas recibidas',     'faltas_recibidas'],
    ['📊 Ratio goles/partido','ratio_goles_por_partido'],
];
@endphp

<table class="table table-hover align-middle text-center">
    <thead>
        <tr>
            <th class="text-start" style="width:35%">Estadística</th>
            <th style="color:#FF6600">{{ $jugadorA->nombre }}</th>
            <th class="text-muted">vs</th>
            <th style="color:#111111">{{ $jugadorB->nombre }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach($filas as [$label, $key])
    @php
        $valA = $statsA[$key];
        $valB = $statsB[$key];
        $mejorA = $valA > $valB;
        $mejorB = $valB > $valA;
    @endphp
    <tr>
        <td class="text-start fw-bold">{{ $label }}</td>
        <td class="fs-5 {{ $mejorA ? 'fw-bold text-success' : '' }}">
            {{ $valA }}
            @if($mejorA) <span class="small">✅</span> @endif
        </td>
        <td class="text-muted">–</td>
        <td class="fs-5 {{ $mejorB ? 'fw-bold text-success' : '' }}">
            {{ $valB }}
            @if($mejorB) <span class="small">✅</span> @endif
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

</div>
</div>
@endif

@endsection