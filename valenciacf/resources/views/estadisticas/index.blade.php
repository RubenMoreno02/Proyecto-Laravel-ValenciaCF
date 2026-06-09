@extends('layouts.app')
@section('content')
<h1 class="mb-4">Estadísticas de la temporada</h1>

<div class="text-end mb-3">
    <a href="{{ route('estadisticas.comparar') }}" class="btn btn-vcf">Comparar jugadores</a>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header" style="background:#FF6600;color:white;">⚽ Máximos goleadores</div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead><tr><th>#</th><th>Jugador</th><th class="text-center">Goles</th></tr></thead>
                    <tbody>
                    @foreach($goleadores as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><a href="{{ route('jugadores.show', $r['jugador']) }}">{{ $r['jugador']->nombre }}</a></td>
                        <td class="text-center fw-bold">{{ $r['goles'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header" style="background:#FF6600;color:white;">🅰️ Máximos asistentes</div>
            <div class="card-body p-0">
                <table class="table table-sm mb-0">
                    <thead><tr><th>#</th><th>Jugador</th><th class="text-center">Asistencias</th></tr></thead>
                    <tbody>
                    @foreach($asistentes as $i => $r)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td><a href="{{ route('jugadores.show', $r['jugador']) }}">{{ $r['jugador']->nombre }}</a></td>
                        <td class="text-center fw-bold">{{ $r['asistencias'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection