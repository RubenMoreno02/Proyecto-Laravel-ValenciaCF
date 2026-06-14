@extends('layouts.app')
@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h1 class="mb-0">Noticias</h1>
        <p class="text-muted mb-0">Toda la actualidad del Valencia CF</p>
    </div>
    <img src="{{ asset('images/escudo.png') }}" style="height:50px" alt="VCF"
         onerror="this.style.display='none'">
</div>

{{-- NOTICIAS DESTACADAS --}}
@if($destacadas->count())
<div class="row g-4 mb-5">
    {{-- NOTICIA PRINCIPAL --}}
    <div class="col-md-7">
        @php $p = $destacadas->first() @endphp
        <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius:16px">
            <img src="{{ $p['imagen'] }}" alt="{{ $p['titulo'] }}"
                 style="height:300px;object-fit:cover;width:100%">
            <div class="card-body">
                <span class="badge mb-2" style="background:#FF6600">{{ $p['categoria'] }}</span>
                <h3 class="fw-bold mb-1">{{ $p['titulo'] }}</h3>
                <p class="text-muted">{{ $p['subtitulo'] }}</p>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="text-muted small">
                        📅 {{ \Carbon\Carbon::parse($p['fecha'])->format('d/m/Y') }}
                    </span>
                    <a href="{{ route('noticias.show', $p['id']) }}" class="btn btn-vcf btn-sm">Leer más</a>
                </div>
            </div>
        </div>
    </div>

    {{-- NOTICIAS SECUNDARIAS DESTACADAS --}}
    <div class="col-md-5">
        <div class="d-flex flex-column gap-3 h-100">
            @foreach($destacadas->skip(1) as $n)
            <a href="{{ route('noticias.show', $n['id']) }}" class="text-decoration-none h-100 text-dark">
                <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius:14px">
                    <div class="row g-0 h-100">
                        <div class="col-4">
                            <img src="{{ $n['imagen'] }}" alt="{{ $n['titulo'] }}"
                                 style="width:100%;height:100%;object-fit:cover;min-height:120px">
                        </div>
                        <div class="col-8">
                            <div class="card-body py-3 px-3">
                                <span class="badge mb-1" style="background:#111111;font-size:.65rem">
                                    {{ $n['categoria'] }}
                                </span>
                                <h6 class="fw-bold mb-1" style="line-height:1.3">{{ $n['titulo'] }}</h6>
                                <p class="text-muted mb-2" style="font-size:.8rem">
                                    {{ Str::limit($n['subtitulo'], 70) }}
                                </p>
                                <span class="text-muted" style="font-size:.72rem">
                                    {{ \Carbon\Carbon::parse($n['fecha'])->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- SEPARADOR CON CATEGORÍAS --}}
<div class="d-flex align-items-center gap-3 mb-4">
    <h4 class="fw-bold mb-0">Más noticias</h4>
    <div class="flex-grow-1 border-bottom" style="border-color:#FF6600 !important;border-width:2px !important"></div>
</div>

{{-- GRID DE NOTICIAS --}}
<div class="row g-4">
    @foreach($resto as $n)
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100 card-jugador overflow-hidden" style="border-radius:14px">
            <img src="{{ $n['imagen'] }}" alt="{{ $n['titulo'] }}"
                 style="height:180px;object-fit:cover">
            <div class="card-body d-flex flex-column">
                <span class="badge mb-2 align-self-start" style="background:#FF6600;font-size:.7rem">{{ $n['categoria'] }}</span>
                <h6 class="fw-bold mb-1">{{ $n['titulo'] }}</h6>
                <p class="text-muted small mb-3">{{ Str::limit($n['subtitulo'], 90) }}</p>
                <div class="d-flex align-items-center justify-content-between mt-auto">
                    <span class="text-muted" style="font-size:.72rem">
                        📅 {{ \Carbon\Carbon::parse($n['fecha'])->format('d M Y') }}
                    </span>
                    <a href="{{ route('noticias.show', $n['id']) }}" class="btn btn-sm btn-vcf">Leer →</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection