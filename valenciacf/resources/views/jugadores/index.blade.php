@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Plantilla 2025/26</h1>
    @auth @if(auth()->user()->rol === 'admin')
        <a href="{{ route('admin.jugadores.create') }}" class="btn btn-vcf">+ Nuevo jugador</a>
    @endif @endauth
</div>

<form class="row g-2 mb-4">
    <div class="col-md-4">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre..." value="{{ request('buscar') }}">
    </div>
    <div class="col-md-3">
        <select name="posicion" class="form-select">
            <option value="">Todas las posiciones</option>
            @foreach(['Portero','Defensa','Medio','Delantero'] as $pos)
                <option value="{{ $pos }}" {{ request('posicion') == $pos ? 'selected' : '' }}>{{ $pos }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-vcf w-100">Filtrar</button>
    </div>
</form>

<div class="row row-cols-2 row-cols-md-4 g-3">
    @forelse($jugadores as $jugador)
        @php $stats = calcularEstadisticasTemporada($jugador->id); @endphp
        <div class="col">
            <div class="card card-jugador h-100 shadow-sm">
                <div class="position-relative">
                    @if($jugador->foto_url)
                        <img src="{{ asset('storage/' . $jugador->foto_url) }}"
                             class="card-img-top" style="height:180px;object-fit:cover;">
                    @else
                        <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                             style="height:180px;font-size:4rem;">👤</div>
                    @endif
                    <span class="badge-dorsal position-absolute top-0 end-0 m-2">{{ $jugador->dorsal }}</span>
                </div>
                <div class="card-body p-2 text-center">
                    <a href="{{ route('jugadores.show', $jugador) }}" class="text-decoration-none text-dark">
                        <strong>{{ $jugador->nombre }}</strong>
                    </a>
                    <div class="text-muted small">{{ $jugador->posicion }}</div>
                    <div class="mt-1 small">
                        ⚽ {{ $stats['goles'] }} &nbsp; 🅰️ {{ $stats['asistencias'] }}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><p class="text-muted">No se encontraron jugadores.</p></div>
    @endforelse
</div>

<div class="mt-4">{{ $jugadores->withQueryString()->links() }}</div>
@endsection