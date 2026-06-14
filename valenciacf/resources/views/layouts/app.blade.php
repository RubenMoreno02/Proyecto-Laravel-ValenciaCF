<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Estadística — Valencia CF</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --vcf-naranja: #FF6600;
            --vcf-negro: #111111;
            --vcf-gris: #F4F4F4;
        }
        * { box-sizing: border-box; }
        body { background: var(--vcf-gris); font-family: 'Segoe UI', sans-serif; margin: 0; }

        /* ── NAVBAR ── */
        .navbar-vcf {
            background: #0d0d0d;
            border-bottom: 3px solid var(--vcf-naranja);
            padding: .5rem 0;
            position: sticky;
            top: 0;
            z-index: 1050;
        }
        .navbar-brand-vcf {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .navbar-brand-vcf img { height: 40px; }
        .navbar-brand-vcf .brand-text { color: #fff; font-weight: 700; font-size: 1rem; line-height: 1.2; }
        .navbar-brand-vcf .brand-sub  { display: block; color: var(--vcf-naranja); font-size: .65rem; letter-spacing: 1.5px; text-transform: uppercase; font-weight: 400; }

        /* Links del nav */
        .navbar-vcf .nav-link {
            color: #bbb !important;
            font-size: .9rem;
            font-weight: 500;
            padding: .45rem .85rem !important;
            border-radius: 6px;
            transition: color .2s, background .2s;
            white-space: nowrap;
        }
        .navbar-vcf .nav-link:hover,
        .navbar-vcf .nav-link.active { color: #fff !important; background: rgba(255,102,0,.18); }
        .navbar-vcf .dropdown-menu {
            background: #1a1a1a;
            border: none;
            border-top: 2px solid var(--vcf-naranja) !important;
            border-radius: 10px;
            padding: .4rem;
            min-width: 200px;
        }
        .navbar-vcf .dropdown-item { color: #bbb; border-radius: 6px; font-size: .88rem; padding: .5rem .9rem; }
        .navbar-vcf .dropdown-item:hover { background: rgba(255,102,0,.18); color: #fff; }

        /* Menú hamburguesa — fondo oscuro */
        @media (max-width: 991px) {
            .navbar-vcf .navbar-collapse {
                background: #141414;
                border-top: 1px solid #2a2a2a;
                border-radius: 0 0 12px 12px;
                padding: .75rem 1rem 1rem;
                margin-top: .4rem;
            }
            .navbar-vcf .navbar-nav { gap: 2px; }
            .navbar-vcf .nav-link { padding: .55rem .75rem !important; }
            .navbar-vcf .dropdown-menu {
                background: #0d0d0d;
                border-top: none !important;
                margin-left: .5rem;
            }
            .navbar-vcf .nav-divider { border-color: #2a2a2a; }
            .user-area { border-top: 1px solid #2a2a2a; padding-top: .75rem; margin-top: .5rem; }
        }

        /* Avatar usuario */
        .user-avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: var(--vcf-naranja);
            display: inline-flex; align-items: center; justify-content: center;
            color: white; font-weight: 700; font-size: .85rem;
        }

        /* ── BOTONES ── */
        .btn-vcf {
            background: var(--vcf-naranja) !important;
            color: #fff !important;
            border: none;
            font-weight: 600;
            transition: background .2s, transform .15s, box-shadow .2s;
        }
        .btn-vcf:hover {
            background: #e05500 !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(255,102,0,.35);
        }
        .btn-outline-vcf {
            border: 2px solid var(--vcf-naranja);
            color: var(--vcf-naranja);
            font-weight: 600;
            background: transparent;
            transition: all .2s;
        }
        .btn-outline-vcf:hover { background: var(--vcf-naranja); color: #fff; }

        /* ── CARDS ── */
        .card { border-radius: 14px !important; }
        .card-jugador { transition: transform .2s, box-shadow .2s; }
        .card-jugador:hover { transform: translateY(-4px); box-shadow: 0 10px 28px rgba(0,0,0,.12) !important; }

        /* Card headers */
        .card-header-dark   { background: #111 !important; color: #fff; border-radius: 14px 14px 0 0 !important; padding: .85rem 1.1rem; font-weight: 600; }
        .card-header-orange { background: var(--vcf-naranja) !important; color: #fff; border-radius: 14px 14px 0 0 !important; padding: .85rem 1.1rem; font-weight: 600; }

        /* Alias para compatibilidad */
        .card-header-vcf-dark   { background: #111 !important; color: #fff; border-radius: 14px 14px 0 0 !important; padding: .85rem 1.1rem; font-weight: 600; }
        .card-header-vcf-orange { background: var(--vcf-naranja) !important; color: #fff; border-radius: 14px 14px 0 0 !important; padding: .85rem 1.1rem; font-weight: 600; }

        /* Dorsal badge */
        .badge-dorsal {
            background: var(--vcf-naranja); color: #fff;
            border-radius: 50%; width: 28px; height: 28px;
            display: inline-flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: .78rem;
        }

        /* ── TABLAS ── */
        .table thead th {
            background: #111 !important; color: #fff;
            font-weight: 600; border: none; font-size: .85rem;
        }

        /* ── HERO ── */
        .hero-vcf {
            background: linear-gradient(135deg, #0d0d0d 0%, #1c1c1c 55%, #2e1200 100%);
            border-radius: 16px;
            border: 1px solid rgba(255,102,0,.15);
            position: relative; overflow: hidden;
        }
        .hero-vcf::after {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(circle at 75% 50%, rgba(255,102,0,.1) 0%, transparent 65%);
            pointer-events: none;
        }

        /* ── RESULTADOS ── */
        .result-V { color: #22c55e; font-weight: 700; }
        .result-E { color: #f59e0b; font-weight: 700; }
        .result-D { color: #ef4444; font-weight: 700; }

        /* ── PAGINACIÓN ── */
        .page-link { color: var(--vcf-naranja) !important; }
        .page-item.active .page-link { background: var(--vcf-naranja) !important; border-color: var(--vcf-naranja) !important; color: #fff !important; }

        /* ── FOOTER ── */
        .footer-vcf { background: #0d0d0d; border-top: 3px solid var(--vcf-naranja); }
        .footer-link { color: #777; text-decoration: none; font-size: .85rem; transition: color .2s; }
        .footer-link:hover { color: var(--vcf-naranja); }

        /* ── AVATARES JUGADOR ── */
        .jugador-avatar { width: 100%; height: 200px; object-fit: cover; object-position: top center; }
        .jugador-avatar-ph {
            width: 100%; height: 200px;
            background: linear-gradient(135deg,#1a1a1a,#333);
            display: flex; align-items: center; justify-content: center;
            font-size: 3.5rem; color: rgba(255,102,0,.3);
        }
    </style>
</head>
<body>

{{-- ════════════ NAVBAR ════════════ --}}
<nav class="navbar navbar-expand-lg navbar-vcf">
  <div class="container">

    {{-- LOGO --}}
    <a class="navbar-brand-vcf" href="{{ route('home') }}">
      <img src="{{ asset('images/escudo.png') }}" alt="VCF" onerror="this.style.display='none'">
      <span class="brand-text">VCF Stats
        <small class="brand-sub">Gestión Estadística</small>
      </span>
    </a>

    {{-- TOGGLER --}}
    <button class="navbar-toggler border-0 p-1" type="button"
            data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="Menú">
      <svg width="26" height="22" viewBox="0 0 26 22" fill="none">
        <rect width="26" height="3" rx="2" fill="#FF6600"/>
        <rect y="9"  width="26" height="3" rx="2" fill="#FF6600"/>
        <rect y="18" width="26" height="3" rx="2" fill="#FF6600"/>
      </svg>
    </button>

    {{-- LINKS --}}
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav mx-auto gap-1">

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('jugadores*') ? 'active' : '' }}"
             href="{{ route('jugadores.index') }}">👤 Plantilla</a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('partidos*') ? 'active' : '' }}"
             href="{{ route('partidos.index') }}">🏟️ Partidos</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request()->routeIs('estadisticas*','clasificacion*') ? 'active' : '' }}"
             href="#" data-bs-toggle="dropdown">📊 Estadísticas</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('estadisticas.index') }}">📊 Estadísticas</a></li>
            <li><a class="dropdown-item" href="{{ route('estadisticas.comparar') }}">⚖️ Comparador</a></li>
            <li><a class="dropdown-item" href="{{ route('clasificacion.index') }}">📈 Clasificación</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('noticias*') ? 'active' : '' }}"
             href="{{ route('noticias.index') }}">📰 Noticias</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request()->routeIs('titulos*','historia*','lesiones*') ? 'active' : '' }}"
             href="#" data-bs-toggle="dropdown">🏆 Club</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('titulos.index') }}">🏆 Palmarés</a></li>
            <li><a class="dropdown-item" href="{{ route('historia.index') }}">📖 Historia</a></li>
            <li><a class="dropdown-item" href="{{ route('lesiones.index') }}">🏥 Lesiones</a></li>
          </ul>
        </li>

      </ul>

      {{-- USUARIO --}}
      <ul class="navbar-nav user-area">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
               href="#" data-bs-toggle="dropdown">
              <span class="user-avatar">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</span>
              <span style="color:#ccc;font-size:.88rem">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              @if(auth()->user()->rol === 'admin')
                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">⚙️ Panel Admin</a></li>
                <li><hr class="dropdown-divider" style="border-color:#2a2a2a"></li>
              @endif
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item" style="color:#ef4444">🚪 Cerrar sesión</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
          </li>
          <li class="nav-item ms-1">
            <a class="btn btn-vcf btn-sm px-3 py-1 my-1" href="{{ route('register') }}">Registrarse</a>
          </li>
        @endauth
      </ul>
    </div>

  </div>
</nav>

{{-- ════════════ CONTENIDO ════════════ --}}
<main class="container my-4">
    @include('components.alert')
    @yield('content')
</main>

{{-- ════════════ FOOTER ════════════ --}}
<footer class="footer-vcf mt-5">
  <div class="container py-5">
    <div class="row g-4">

      {{-- COLUMNA 1: LOGO --}}
      <div class="col-md-4 col-lg-3">
        <div class="d-flex align-items-center gap-2 mb-3">
          <img src="{{ asset('images/escudo.png') }}" style="height:38px" alt="VCF"
               onerror="this.style.display='none'">
          <div>
            <div class="fw-bold text-white" style="font-size:.95rem">Valencia CF</div>
            <div style="color:var(--vcf-naranja);font-size:.7rem;letter-spacing:1.2px;text-transform:uppercase">Gestión Estadística</div>
          </div>
        </div>
        <p style="color:#555;font-size:.83rem;line-height:1.65">
          Plataforma de estadísticas y seguimiento deportivo del Valencia CF. Temporada 2025/26.
        </p>
        <div class="d-flex gap-3 mt-2">
          @foreach(['𝕏','📷','▶','📘'] as $icon)
          <a href="#" style="color:#555;font-size:1.15rem;text-decoration:none;transition:color .2s"
             onmouseover="this.style.color='#FF6600'" onmouseout="this.style.color='#555'">{{ $icon }}</a>
          @endforeach
        </div>
      </div>

      {{-- COLUMNA 2: NAVEGACIÓN --}}
      <div class="col-6 col-md-2">
        <h6 style="color:var(--vcf-naranja);font-size:.75rem;letter-spacing:.8px;text-transform:uppercase;font-weight:700" class="mb-3">Secciones</h6>
        <ul class="list-unstyled mb-0">
          @foreach([
            ['Plantilla',     route('jugadores.index')],
            ['Partidos',      route('partidos.index')],
            ['Estadísticas',  route('estadisticas.index')],
            ['Comparador',    route('estadisticas.comparar')],
            ['Clasificación', route('clasificacion.index')],
            ['Noticias',      route('noticias.index')],
            ['Palmarés',      route('titulos.index')],
            ['Historia',      route('historia.index')],
            ['Lesiones',      route('lesiones.index')],
          ] as [$l,$r])
          <li class="mb-1"><a href="{{ $r }}" class="footer-link">{{ $l }}</a></li>
          @endforeach
        </ul>
      </div>

      {{-- COLUMNA 3: LEGAL --}}
      <div class="col-6 col-md-3">
        <h6 style="color:var(--vcf-naranja);font-size:.75rem;letter-spacing:.8px;text-transform:uppercase;font-weight:700" class="mb-3">Legal</h6>
        <ul class="list-unstyled mb-0">
          @foreach(['Aviso Legal','Política de Privacidad','Aviso de Cookies','Configuració de les galetes','Accesibilidad',"FAQ's",'Contactos'] as $item)
          <li class="mb-1"><a href="#" class="footer-link">{{ $item }}</a></li>
          @endforeach
        </ul>
      </div>

      {{-- COLUMNA 4: CONTACTO --}}
      <div class="col-md-3">
        <h6 style="color:var(--vcf-naranja);font-size:.75rem;letter-spacing:.8px;text-transform:uppercase;font-weight:700" class="mb-3">Contacto</h6>
        <ul class="list-unstyled mb-0" style="color:#555;font-size:.84rem">
          <li class="mb-2">📍 Avda. de Suècia, s/n · 46010 Valencia</li>
          <li class="mb-2">📞 <a href="tel:+34963374764" class="footer-link">+34 963 37 47 64</a></li>
          <li class="mb-2">✉️ <a href="mailto:info@valenciacf.es" class="footer-link">info@valenciacf.es</a></li>
          <li>🌐 <a href="https://www.valenciacf.com" target="_blank" class="footer-link">valenciacf.com</a></li>
        </ul>
      </div>

    </div>

    <hr style="border-color:#1e1e1e;margin:2rem 0 1.2rem">

    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
      <p style="color:#383838;font-size:.78rem;margin:0">© {{ date('Y') }} Valencia CF · Todos los derechos reservados</p>
      <p style="color:#383838;font-size:.75rem;margin:0">Proyecto académico · IES Enric Valor · 2º CFGS DAW · Rubén Moreno Sisternes</p>
      <p style="color:#383838;font-size:.75rem;margin:0">Hecho con ❤️ en Valencia</p>
    </div>
  </div>
</footer>

</body>
</html>