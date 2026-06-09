@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Partidos 2025/26</h1>
    @auth @if(auth()->user()->rol === 'admin')
        <a href="{{ route('admin.partidos.create') }}" class="btn btn-vcf">+ Nuevo partido</a>
    @endif @endauth
</div>

<form class="row g-2 mb-3">
    <div class="col-md-4">
        <select name="competicion" class="form-select">
            <option value="">Todas las competiciones</option>
            @foreach(['Liga','Copa del Rey','Europa League','Champions League','Supercopa'] as $c)
                <option value="{{ $c }}" {{ request('competicion') == $c ? 'selected' : '' }}>{{ $c }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-vcf w-100">Filtrar</button>
    </div>
</form>

<div class="table-responsive">
<table class="table table-striped table-hover">
    <thead>
        <tr><th>Fecha</th><th>Rival</th><th>Competición</th><th>Sede</th><th>Resultado</th><th></th></tr>
    </thead>
    <tbody>
    @forelse($partidos as $partido)
        <tr>
            <td>{{ $partido->fecha->format('d/m/Y') }}</td>
            <td>{{ $partido->rival }}</td>
            <td><span class="badge bg-secondary">{{ $partido->competicion }}</span></td>
            <td>{{ $partido->sede }}</td>
            <td>
                <span class="fw-bold {{ $partido->resultado === 'Victoria' ? 'text-success' : ($partido->resultado === 'Derrota' ? 'text-danger' : 'text-warning') }}">
                    {{ $partido->goles_favor }} – {{ $partido->goles_contra }}
                    ({{ $partido->resultado }})
                </span>
            </td>
            <td><a href="{{ route('partidos.show', $partido) }}" class="btn btn-sm btn-vcf">Ver</a></td>
        </tr>
    @empty
        <tr><td colspan="6" class="text-center text-muted">No hay partidos registrados.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
{{ $partidos->withQueryString()->links() }}
@endsection