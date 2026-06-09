@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-3 text-center">
        @if($jugador->foto_url)
            <img src="{{ asset('storage/' . $jugador->foto_url) }}"
                class="rounded-circle shadow mb-3"
                style="width:160px;height:160px;object-fit:cover;object-position:top;border:4px solid #FF6600"
                onerror="this.outerHTML='<div class=\'rounded-circle bg-dark d-flex align-items-center justify-content-center mx-auto mb-3\' style=\'width:160px;height:160px;font-size:4rem;border:4px solid #FF6600\'>⚽</div>'">
        @else
            <div class="rounded-circle bg-dark d-flex align-items-center justify-content-center mx-auto mb-3"
                style="width:160px;height:160px;font-size:4rem;border:4px solid #FF6600">⚽</div>
        @endif
        <h2>{{ $jugador->nombre }}</h2>
        <span class="badge-dorsal d-inline-block mb-2">{{ $jugador->dorsal }}</span>
        <p class="text-muted">{{ $jugador->posicion }} · {{ $jugador->nacionalidad }}</p>
        <p class="small text-muted">Edad: {{ $jugador->edad }} años<br>
        En el club desde {{ $jugador->fecha_incorporacion->format('Y') }}</p>

        @auth @if(auth()->user()->rol === 'admin')
            <a href="{{ route('admin.jugadores.edit', $jugador) }}" class="btn btn-vcf btn-sm w-100 mb-2">Editar</a>
            <form method="POST" action="{{ route('admin.jugadores.destroy', $jugador) }}"
                  onsubmit="return confirm('¿Dar de baja a este jugador?')">
                @csrf @method('DELETE')
                <button class="btn btn-outline-danger btn-sm w-100">Dar de baja</button>
            </form>
        @endif @endauth
    </div>

    <div class="col-md-9">
        <h4 class="mb-3">Estadísticas de la temporada 2025/26</h4>
        <div class="row row-cols-2 row-cols-md-5 g-2 mb-4">
            @foreach([
                ['⚽','Goles',$stats['goles']],
                ['🅰️','Asistencias',$stats['asistencias']],
                ['🟨','Amarillas',$stats['amarillas']],
                ['🟥','Rojas',$stats['rojas']],
                ['⏱️','Minutos',$stats['minutos_totales']],
            ] as [$icon, $label, $val])
            <div class="col">
                <div class="card text-center shadow-sm">
                    <div class="card-body p-2">
                        <div style="font-size:1.8rem;">{{ $icon }}</div>
                        <div class="fw-bold fs-4">{{ $val }}</div>
                        <div class="text-muted small">{{ $label }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($lesiones->count())
        <h5>Historial de lesiones</h5>
        <table class="table table-sm table-striped">
            <thead><tr><th>Lesión</th><th>Desde</th><th>Estado</th></tr></thead>
            <tbody>
            @foreach($lesiones as $l)
                <tr>
                    <td>{{ $l->tipo_lesion }}</td>
                    <td>{{ $l->fecha_inicio->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $l->estado === 'Recuperado' ? 'bg-success' : 'bg-danger' }}">
                            {{ $l->estado }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection