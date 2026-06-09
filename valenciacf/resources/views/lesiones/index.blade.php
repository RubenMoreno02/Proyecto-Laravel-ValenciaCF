@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Lesiones activas</h1>
    @auth @if(auth()->user()->rol === 'admin')
        <a href="{{ route('admin.lesiones.create') }}" class="btn btn-vcf">+ Registrar lesión</a>
    @endif @endauth
</div>

@if($lesionesActivas->count())
<div class="row g-3">
@foreach($lesionesActivas as $l)
<div class="col-md-6">
    <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
            <div class="d-flex align-items-center mb-2">
                <div class="me-3" style="font-size:2rem">🏥</div>
                <div>
                    <h5 class="mb-0 fw-bold">
                        <a href="{{ route('jugadores.show', $l->jugador) }}" class="text-decoration-none text-dark">
                            {{ $l->jugador->nombre }}
                        </a>
                    </h5>
                    <span class="badge bg-light text-dark">{{ $l->jugador->posicion }}</span>
                </div>
                <span class="ms-auto badge fs-6
                    {{ $l->estado === 'Baja larga' ? 'bg-danger' :
                       ($l->estado === 'En tratamiento' ? 'bg-warning text-dark' : 'bg-success') }}">
                    {{ $l->estado }}
                </span>
            </div>
            <p class="mb-1"><strong>Lesión:</strong> {{ $l->tipo_lesion }}</p>
            <p class="mb-1 small text-muted">
                Desde: {{ $l->fecha_inicio->format('d/m/Y') }}
                @if($l->fecha_estimada_vuelta)
                    · Vuelta estimada: <strong>{{ $l->fecha_estimada_vuelta->format('d/m/Y') }}</strong>
                @endif
            </p>
            @if($l->observaciones)
                <p class="mb-0 small text-muted fst-italic">{{ $l->observaciones }}</p>
            @endif

            @auth @if(auth()->user()->rol === 'admin')
            <div class="mt-3 d-flex gap-2">
                <a href="{{ route('admin.lesiones.edit', $l) }}" class="btn btn-sm btn-vcf">Editar</a>
                <form method="POST" action="{{ route('admin.lesiones.destroy', $l) }}"
                      onsubmit="return confirm('¿Eliminar esta lesión?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger">Eliminar</button>
                </form>
            </div>
            @endif @endauth
        </div>
    </div>
</div>
@endforeach
</div>

<div class="mt-4">{{ $lesionesActivas->links() }}</div>

@else
<div class="text-center py-5">
    <div style="font-size:4rem">🎉</div>
    <h3 class="mt-3">¡No hay lesiones activas!</h3>
    <p class="text-muted">Toda la plantilla está disponible.</p>
</div>
@endif

@endsection