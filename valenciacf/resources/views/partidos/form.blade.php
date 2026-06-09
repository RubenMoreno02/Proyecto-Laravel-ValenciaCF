@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
<div class="col-md-8">

<h2 class="mb-4">{{ $partido->exists ? 'Editar partido' : 'Registrar nuevo partido' }}</h2>

<form method="POST"
      action="{{ $partido->exists ? route('admin.partidos.update', $partido) : route('admin.partidos.store') }}">
    @csrf
    @if($partido->exists) @method('PUT') @endif

    <div class="card shadow-sm border-0">
    <div class="card-body">
    <div class="row g-3">

        <div class="col-md-8">
            <label class="form-label fw-bold">Rival *</label>
            <input type="text" name="rival" class="form-control @error('rival') is-invalid @enderror"
                   value="{{ old('rival', $partido->rival) }}" placeholder="Ej: Real Madrid" required>
            @error('rival') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Fecha *</label>
            <input type="date" name="fecha" class="form-control @error('fecha') is-invalid @enderror"
                   value="{{ old('fecha', $partido->fecha?->format('Y-m-d')) }}" required>
        </div>

        <div class="col-md-5">
            <label class="form-label fw-bold">Competición *</label>
            <select name="competicion" class="form-select @error('competicion') is-invalid @enderror" required>
                @foreach(['Liga','Copa del Rey','Europa League','Champions League','Supercopa'] as $c)
                    <option value="{{ $c }}" {{ old('competicion', $partido->competicion) == $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-bold">Jornada</label>
            <input type="number" name="jornada" class="form-control"
                   value="{{ old('jornada', $partido->jornada) }}" min="1" max="38" placeholder="Solo Liga">
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Sede *</label>
            <select name="sede" class="form-select" required>
                @foreach(['Local','Visitante'] as $s)
                    <option value="{{ $s }}" {{ old('sede', $partido->sede) == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Estadio</label>
            <input type="text" name="estadio" class="form-control"
                   value="{{ old('estadio', $partido->estadio) }}" placeholder="Ej: Mestalla">
        </div>

        <div class="col-12"><hr><h5 class="mb-3">Resultado</h5></div>

        <div class="col-md-3">
            <label class="form-label fw-bold">Goles VCF *</label>
            <input type="number" name="goles_favor" class="form-control @error('goles_favor') is-invalid @enderror"
                   value="{{ old('goles_favor', $partido->goles_favor ?? 0) }}" min="0" required>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-bold">Goles rival *</label>
            <input type="number" name="goles_contra" class="form-control @error('goles_contra') is-invalid @enderror"
                   value="{{ old('goles_contra', $partido->goles_contra ?? 0) }}" min="0" required>
        </div>

    </div>
    </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <button type="submit" class="btn btn-vcf btn-lg">💾 Guardar partido</button>
        <a href="{{ route('partidos.index') }}" class="btn btn-outline-secondary btn-lg">Cancelar</a>
    </div>
</form>

</div>
</div>
@endsection