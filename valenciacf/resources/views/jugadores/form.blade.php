@extends('layouts.app')
@section('content')
<h2>{{ $jugador->exists ? 'Editar jugador' : 'Nuevo jugador' }}</h2>

<form method="POST"
      action="{{ $jugador->exists ? route('admin.jugadores.update', $jugador) : route('admin.jugadores.store') }}"
      enctype="multipart/form-data">
    @csrf
    @if($jugador->exists) @method('PUT') @endif

    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">Nombre completo *</label>
            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                   value="{{ old('nombre', $jugador->nombre) }}" required>
            @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-2">
            <label class="form-label">Dorsal *</label>
            <input type="number" name="dorsal" class="form-control @error('dorsal') is-invalid @enderror"
                   value="{{ old('dorsal', $jugador->dorsal) }}" min="1" max="99" required>
            @error('dorsal') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="col-md-4">
            <label class="form-label">Posición *</label>
            <select name="posicion" class="form-select @error('posicion') is-invalid @enderror" required>
                @foreach(['Portero','Defensa','Medio','Delantero'] as $pos)
                    <option value="{{ $pos }}" {{ old('posicion', $jugador->posicion) == $pos ? 'selected' : '' }}>{{ $pos }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Nacionalidad *</label>
            <input type="text" name="nacionalidad" class="form-control"
                   value="{{ old('nacionalidad', $jugador->nacionalidad) }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Fecha de nacimiento *</label>
            <input type="date" name="fecha_nacimiento" class="form-control"
                   value="{{ old('fecha_nacimiento', $jugador->fecha_nacimiento?->format('Y-m-d')) }}" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Fecha de incorporación *</label>
            <input type="date" name="fecha_incorporacion" class="form-control"
                   value="{{ old('fecha_incorporacion', $jugador->fecha_incorporacion?->format('Y-m-d')) }}" required>
        </div>
        <div class="col-md-3">
            <label class="form-label">Altura (cm)</label>
            <input type="number" name="altura_cm" class="form-control"
                   value="{{ old('altura_cm', $jugador->altura_cm) }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">Peso (kg)</label>
            <input type="number" step="0.1" name="peso_kg" class="form-control"
                   value="{{ old('peso_kg', $jugador->peso_kg) }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">Foto de perfil</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
            @if($jugador->foto_url)
                <small class="text-muted">Foto actual:
                    <img src="{{ asset('storage/' . $jugador->foto_url) }}" height="40" class="rounded ms-1">
                </small>
            @endif
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-vcf">Guardar</button>
        <a href="{{ route('jugadores.index') }}" class="btn btn-outline-secondary ms-2">Cancelar</a>
    </div>
</form>
@endsection