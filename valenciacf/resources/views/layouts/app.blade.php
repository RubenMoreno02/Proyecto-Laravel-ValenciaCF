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
            --vcf-gris: #F8F8F8;
        }

        * { box-sizing: border-box; }
        body { background: var(--vcf-gris); font-family: 'Segoe UI', sans-serif; }

        /* NAVBAR */
        .navbar-vcf {
            background: linear-gradient(90deg, #0a0a0a 0%, #1a1a1a 100%);
            border-bottom: 3px solid var(--vcf-naranja);
            padding: 0.6rem 0;
        }
        .navbar-vcf .nav-link {
            color: #ccc !important;
            font-weight: 500;
            letter-spacing: .3px;
            padding: .5rem 1rem !important;
            border-radius: 6px;
            transition: all .2s;
        }
        .navbar-vcf .nav-link:hover {
            color: #fff !important;
            background: rgba(255,102,0,.15);
        }
        .navbar-brand-vcf {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }
        .navbar-brand-vcf img {
            height: 42px;
            filter: drop-shadow(0 0 4px rgba(255,102,0,.4));
        }
        .navbar-brand-vcf span {
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
            line-height: 1.2;
        }
        .navbar-brand-vcf small {
            display: block;
            color: var(--vcf-naranja);
            font-size: .7rem;
            font-weight: 400;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* BOTONES */
        .btn-vcf {
            background: var(--vcf-naranja);
            color: white !important;
            border: none;
            font-weight: 600;
            transition: all .2s;
        }
        .btn-vcf:hover {
            background: #e55a00;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255,102,0,.35);
        }

        /* TARJETAS */
        .card { border-radius: 12px !important; }
        .card-jugador { transition: transform .2s, box-shadow .2s; }
        .card-jugador:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,.12) !important;
        }

        /* DORSAL */
        .badge-dorsal {
            background: var(--vcf-naranja);
            color: white;
            border-radius: 50%;
            width: 30px; height: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .85rem;
        }

        /* TABLAS */
        .table thead th {
            background: var(--vcf-negro) !important;
            color: white;
            font-weight: 600;
            border: none;
        }
        .table thead th:first-child { border-radius: 8px 0 0 0; }
        .table thead th:last-child  { border-radius: 0 8px 0 0; }

        /* SECCIÓN HERO */
        .hero-vcf {
            background: linear-gradient(135deg, #0d0d0d 0%, #1f1f1f 50%, #2a1500 100%);
            border-radius: 16px;
            border: 1px solid rgba(255,102,0,.2);
            position: relative;
            overflow: hidden;
        }
        .hero-vcf::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 80% 50%, rgba(255,102,0,.12) 0%, transparent 60%);
        }

        /* FOOTER */
        footer {
            background: #0d0d0d;
            border-top: 2px solid var(--vcf-naranja);
            color: #666;
        }
        footer img { height: 28px; opacity: .7; }

        /* CARD HEADERS */
        .card-header-vcf-dark  { background: var(--vcf-negro) !important; color: white; border-radius: 12px 12px 0 0 !important; }
        .card-header-vcf-orange { background: var(--vcf-naranja) !important; color: white; border-radius: 12px 12px 0 0 !important; }

        /* STAT PILL */
        .stat-pill {
            background: white;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            padding: .6rem 1rem;
            text-align: center;
            transition: border-color .2s;
        }
        .stat-pill:hover { border-color: var(--vcf-naranja); }
        .stat-pill .value { font-size: 1.8rem; font-weight: 700; color: var(--vcf-negro); }
        .stat-pill .label { font-size: .75rem; color: #888; text-transform: uppercase; letter-spacing: .5px; }

        /* AVATAR jugador */
        .jugador-avatar {
            width: 100%; height: 200px;
            object-fit: cover; object-position: top;
        }
        .jugador-avatar-placeholder {
            width: 100%; height: 200px;
            background: linear-gradient(135deg, #1a1a1a, #333);
            display: flex; align-items: center; justify-content: center;
            font-size: 4rem; color: rgba(255,102,0,.4);
        }

        /* PAGINATION */
        .page-link { color: var(--vcf-naranja) !important; }
        .page-item.active .page-link {
            background: var(--vcf-naranja) !important;
            border-color: var(--vcf-naranja) !important;
            color: white !important;
        }

        /* RESULT BADGES */
        .result-victoria { color: #22c55e; font-weight: 700; }
        .result-derrota  { color: #ef4444; font-weight: 700; }
        .result-empate   { color: #f59e0b; font-weight: 700; }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="navbar navbar-expand-lg navbar-vcf sticky-top">
    <div class="container">
        <a class="navbar-brand-vcf" href="{{ route('home') }}">
            <img src="{{ asset('images/escudo.png') }}" alt="Valencia CF"
                 onerror="this.style.display='none'">
            <span>VCF Stats
                <small>Gestión Estadística</small>
            </span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jugadores*') ? 'text-white' : '' }}"
                       href="{{ route('jugadores.index') }}">👤 Plantilla</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('partidos*') ? 'text-white' : '' }}"
                       href="{{ route('partidos.index') }}">🏟️ Partidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('estadisticas*') ? 'text-white' : '' }}"
                       href="{{ route('estadisticas.index') }}">📊 Estadísticas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('titulos*') ? 'text-white' : '' }}"
                       href="{{ route('titulos.index') }}">🏆 Palmarés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('lesiones*') ? 'text-white' : '' }}"
                       href="{{ route('lesiones.index') }}">🏥 Lesiones</a>
                </li>
            </ul>

            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                           href="#" data-bs-toggle="dropdown">
                            <div style="width:32px;height:32px;border-radius:50%;
                                        background:var(--vcf-naranja);display:flex;
                                        align-items:center;justify-content:center;
                                        font-weight:700;color:white;font-size:.85rem;">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span style="color:#ccc">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0"
                            style="border-top:3px solid var(--vcf-naranja) !important;border-radius:12px;">
                            @if(auth()->user()->rol === 'admin')
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        ⚙️ Panel Admin
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item text-danger">🚪 Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-vcf btn-sm ms-2 my-auto" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- CONTENIDO --}}
<main class="container my-4">
    @include('components.alert')
    @yield('content')
</main>

{{-- FOOTER --}}
<footer class="text-center py-4 mt-5">
    <div class="container d-flex flex-column align-items-center gap-2">
        <img src="{{ asset('images/escudo.png') }}" alt="VCF"
             onerror="this.style.display='none'">
        <div style="color:#555;font-size:.85rem;">
            Valencia CF · Gestión Estadística Temporada 2025/26
        </div>
        <div style="color:#333;font-size:.75rem;">
            Proyecto académico · IES Enric Valor · 2º DAW
        </div>
    </div>
</footer>

</body>
</html>