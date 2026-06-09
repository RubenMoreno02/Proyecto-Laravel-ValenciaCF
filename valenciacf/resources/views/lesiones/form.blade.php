@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
<div class="col-md-7">

<h2 class="mb-4">{{ $lesion->exists ? 'Editar lesión' : 'Registrar nueva lesión' }}</h2>

<form method="POST"
      action="{{ $lesion->exists ? route('admin.lesiones.update', $lesion) : route('admin.lesiones.store') }}">
    @csrf
    @if($lesion->exists) @method('PUT') @endif

    <div class="card shadow-sm border-0">
    <div class="card-body">
    <div class="row g-3">

        <div class="col-12">
            <label class="form-label fw-bold">Jugador *</label>
            <select name="jugador_id" class="form-select @error('jugador_id') is-invalid @enderror" required>
                <option value="">Selecciona un jugador...</option>
                @foreach($jugadores as $j)
                    <option value="{{ $j->id }}"
                        {{ old('jugador_id', $lesion->jugador_id) == $j->id ? 'selected' : '' }}>
                        {{ $j->dorsal }} · {{ $j->nombre }} ({{ $j->posicion }})
                    </option>
                @endforeach
            </select>
            @error('jugador_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Tipo de lesión *</label>
            <input type="text" name="tipo_lesion"
                   class="form-control @error('tipo_lesion') is-invalid @enderror"
                   value="{{ old('tipo_lesion', $lesion->tipo_lesion) }}"
                   placeholder="Ej: Rotura de ligamentos cruzados" required>
            @error('tipo_lesion') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Estado *</label>
            <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                @foreach(['En tratamiento','Baja larga','Recuperado'] as $estado)
                    <option value="{{ $estado }}"
                        {{ old('estado', $lesion->estado) == $estado ? 'selected' : '' }}>
                        {{ $estado }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Fecha inicio *</label>
            <input type="date" name="fecha_inicio" class="form-control @error('fecha_inicio') is-invalid @enderror"
                   value="{{ old('fecha_inicio', $lesion->fecha_inicio?->format('Y-m-d')) }}" required>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Vuelta estimada</label>
            <input type="date" name="fecha_estimada_vuelta" class="form-control"
                   value="{{ old('fecha_estimada_vuelta', $lesion->fecha_estimada_vuelta?->format('Y-m-d')) }}">
        </div>

        <div class="col-12">
            <label class="form-label fw-bold">Observaciones</label>
            <textarea name="observaciones" class="form-control" rows="3"
                      placeholder="Notas adicionales del cuerpo médico...">{{ old('observaciones', $lesion->observaciones) }}</textarea>
        </div>

    </div>
    </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-vcf btn-lg">💾 Guardar</button>
        <a href="{{ route('lesiones.index') }}" class="btn btn-outline-secondary btn-lg">Cancelar</a>
    </div>
</form>

</div>
</div>
@endsection