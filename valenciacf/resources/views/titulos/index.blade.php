@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>🏆 Palmarés del Valencia CF</h1>
    @auth @if(auth()->user()->rol === 'admin')
        <a href="{{ route('admin.titulos.create') }}" class="btn btn-vcf">+ Añadir título</a>
    @endif @endauth
</div>

<div class="row g-4">
@forelse($titulos as $t)
<div class="col-md-6">
    <div class="card shadow-sm border-0 h-100">
        <div class="card-body">
            <div class="d-flex align-items-start">
                <div class="me-3" style="font-size:2.5rem">🏆</div>
                <div class="flex-grow-1">
                    <h5 class="fw-bold mb-1" style="color:#FF6600">{{ $t->competicion }}</h5>
                    <div class="d-flex gap-2 mb-2">
                        <span class="badge" style="background:#111111">📅 {{ $t->anio }}</span>
                        @if($t->entrenador)
                            <span class="badge bg-light text-dark">👔 {{ $t->entrenador }}</span>
                        @endif
                    </div>
                    @if($t->descripcion)
                        <p class="text-muted small mb-0">{{ $t->descripcion }}</p>
                    @endif
                </div>
            </div>
        </div>
        @auth @if(auth()->user()->rol === 'admin')
        <div class="card-footer bg-white d-flex gap-2">
            <a href="{{ route('admin.titulos.edit', $t) }}" class="btn btn-sm btn-vcf">Editar</a>
            <form method="POST" action="{{ route('admin.titulos.destroy', $t) }}"
                  onsubmit="return confirm('¿Eliminar este título del palmarés?')">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Eliminar</button>
            </form>
        </div>
        @endif @endauth
    </div>
</div>
@empty
<div class="col-12 text-center py-5">
    <div style="font-size:4rem">🏆</div>
    <p class="text-muted mt-2">No hay títulos registrados aún.</p>
</div>
@endforelse
</div>

<div class="mt-4">{{ $titulos->links() }}</div>
@endsection