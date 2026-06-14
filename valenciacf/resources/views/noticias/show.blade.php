@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
<div class="col-lg-8">

  {{-- Breadcrumb --}}
  <nav class="mb-3" style="font-size:.85rem">
    <a href="{{ route('home') }}" class="text-muted text-decoration-none">Inicio</a>
    <span class="text-muted mx-1">›</span>
    <a href="{{ route('noticias.index') }}" class="text-muted text-decoration-none">Noticias</a>
    <span class="text-muted mx-1">›</span>
    <span style="color:var(--vcf-naranja)">{{ $noticia['categoria'] }}</span>
  </nav>

  {{-- CABECERA --}}
  <span class="badge mb-3 px-3 py-2" style="background:var(--vcf-naranja);font-size:.8rem">
    {{ $noticia['categoria'] }}
  </span>
  <h1 class="fw-bold mb-2" style="line-height:1.25">{{ $noticia['titulo'] }}</h1>
  <p class="lead text-muted mb-3">{{ $noticia['subtitulo'] }}</p>

  <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
    <div class="user-avatar">📝</div>
    <div>
      <div class="fw-bold small">{{ $noticia['autor'] }}</div>
      <div class="text-muted" style="font-size:.78rem">
        {{ \Carbon\Carbon::parse($noticia['fecha'])->format('d \d\e F \d\e Y') }}
      </div>
    </div>
    <div class="ms-auto d-flex gap-2">
      @foreach($noticia['tags'] as $tag)
        <span class="badge bg-light text-dark" style="font-size:.72rem">{{ $tag }}</span>
      @endforeach
    </div>
  </div>

  {{-- IMAGEN --}}
  <img src="{{ $noticia['imagen'] }}" alt="{{ $noticia['titulo'] }}"
       class="w-100 rounded-3 mb-4 shadow-sm"
       style="max-height:420px;object-fit:cover"
       onerror="this.style.display='none'">

  {{-- CUERPO --}}
  <div style="font-size:1.05rem;line-height:1.85;color:#333">
    @foreach(explode("\n\n", $noticia['cuerpo']) as $parrafo)
      <p>{{ $parrafo }}</p>
    @endforeach
  </div>

  {{-- COMPARTIR --}}
  <div class="border-top border-bottom py-3 my-4 d-flex align-items-center gap-3">
    <span class="fw-bold small text-muted">Compartir:</span>
    <a href="#" class="btn btn-sm btn-outline-secondary">𝕏 Twitter</a>
    <a href="#" class="btn btn-sm btn-outline-secondary">📘 Facebook</a>
    <a href="#" class="btn btn-sm btn-outline-secondary">💬 WhatsApp</a>
    <a href="{{ route('noticias.index') }}" class="btn btn-sm btn-vcf ms-auto">← Volver</a>
  </div>

</div>

{{-- NOTICIAS RELACIONADAS --}}
@if($relacionadas->count())
<div class="col-lg-4">
  <div class="sticky-top" style="top:80px">
    <h5 class="fw-bold mb-3">📰 Más noticias</h5>
    @foreach($relacionadas as $r)
    <a href="{{ route('noticias.show', $r['id']) }}" class="text-decoration-none">
      <div class="card border-0 shadow-sm mb-3 card-jugador overflow-hidden">
        <div class="row g-0">
          <div class="col-4">
            <img src="{{ $r['imagen'] }}" alt="{{ $r['titulo'] }}"
                 style="height:90px;width:100%;object-fit:cover"
                 onerror="this.style.background='#1a1a1a';this.removeAttribute('src')">
          </div>
          <div class="col-8">
            <div class="card-body py-2 px-3">
              <span class="badge mb-1" style="background:var(--vcf-naranja);font-size:.62rem">{{ $r['categoria'] }}</span>
              <p class="fw-bold text-dark mb-0" style="font-size:.82rem;line-height:1.3">
                {{ Str::limit($r['titulo'], 65) }}
              </p>
              <p class="text-muted mb-0 mt-1" style="font-size:.72rem">
                {{ \Carbon\Carbon::parse($r['fecha'])->format('d/m/Y') }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </a>
    @endforeach
  </div>
</div>
@endif

</div>
@endsection