@extends('layouts.app')
@section('content')

<a href="{{ route('titulos.index') }}" class="text-muted text-decoration-none small">← Volver al palmarés</a>

<div class="card shadow-sm border-0 mt-3">
    <div class="card-body p-5 text-center">
        <div style="font-size:5rem">🏆</div>
        <h1 class="fw-bold mt-2" style="color:#FF6600">{{ $titulo->competicion }}</h1>
        <div class="d-flex justify-content-center gap-3 my-3">
            <span class="badge fs-5 px-3 py-2" style="background:#111111">📅 {{ $titulo->anio }}</span>
            @if($titulo->entrenador)
                <span class="badge fs-5 px-3 py-2 bg-light text-dark">👔 {{ $titulo->entrenador }}</span>
            @endif
        </div>
        @if($titulo->descripcion)
            <p class="lead text-muted mt-3 mx-auto" style="max-width:600px">{{ $titulo->descripcion }}</p>
        @endif
    </div>
    @auth @if(auth()->user()->rol === 'admin')
    <div class="card-footer bg-white text-center d-flex justify-content-center gap-3">
        <a href="{{ route('admin.titulos.edit', $titulo) }}" class="btn btn-vcf">Editar</a>
        <form method="POST" action="{{ route('admin.titulos.destroy', $titulo) }}"
              onsubmit="return confirm('¿Eliminar este título?')">
            @csrf @method('DELETE')
            <button class="btn btn-outline-danger">Eliminar</button>
        </form>
    </div>
    @endif @endauth
</div>

@endsection