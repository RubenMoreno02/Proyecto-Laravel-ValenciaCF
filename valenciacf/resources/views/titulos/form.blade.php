@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
<div class="col-md-7">

<h2 class="mb-4">{{ $titulo->exists ? 'Editar título' : 'Añadir título al palmarés' }}</h2>

<form method="POST"
      action="{{ $titulo->exists ? route('admin.titulos.update', $titulo) : route('admin.titulos.store') }}">
    @csrf
    @if($titulo->exists) @method('PUT') @endif

    <div class="card shadow-sm border-0">
    <div class="card-body">
    <div class="row g-3">

        <div class="col-md-8">
            <label class="form-label fw-bold">Competición *</label>
            <input type="text" name="competicion"
                   class="form-control @error('competicion') is-invalid @enderror"
                   value="{{ old('competicion', $titulo->competicion) }}"
                   placeholder="Ej: Liga Española" required>
            @error('competicion') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Año *</label>
            <input type="number" name="anio"
                   class="form-control @error('anio') is-invalid @enderror"
                   value="{{ old('anio', $titulo->anio) }}"
                   min="1900" max="2100" placeholder="Ej: 2004" required>
            @error('anio') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Entrenador</label>
            <input type="text" name="entrenador" class="form-control"
                   value="{{ old('entrenador', $titulo->entrenador) }}"
                   placeholder="Nombre del entrenador en ese título">
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4"
                      placeholder="Resumen del logro y contexto histórico...">{{ old('descripcion', $titulo->descripcion) }}</textarea>
        </div>

    </div>
    </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-vcf btn-lg">💾 Guardar</button>
        <a href="{{ route('titulos.index') }}" class="btn btn-outline-secondary btn-lg">Cancelar</a>
    </div>
</form>

</div>
</div>
@endsection