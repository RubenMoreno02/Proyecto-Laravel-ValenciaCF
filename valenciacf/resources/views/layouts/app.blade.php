<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Estadística VCF</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --vcf-naranja: #FF6600;
            --vcf-negro: #111111;
        }
        body { background: #F8F8F8; }
        .navbar-vcf { background-color: var(--vcf-negro); }
        .btn-vcf { background-color: var(--vcf-naranja); color: white; border: none; }
        .btn-vcf:hover { background-color: #cc5200; color: white; }
        .badge-dorsal {
            background-color: var(--vcf-naranja);
            color: white;
            border-radius: 50%;
            width: 32px; height: 32px;
            display: inline-flex; align-items: center; justify-content: center;
            font-weight: bold;
        }
        .table thead { background-color: var(--vcf-naranja); color: white; }
        .card-jugador { transition: transform .2s; }
        .card-jugador:hover { transform: translateY(-4px); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-vcf navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">⚽ VCF Stats</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('jugadores.index') }}">Plantilla</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('partidos.index') }}">Partidos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('estadisticas.index') }}">Estadísticas</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('titulos.index') }}">Palmarés</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('lesiones.index') }}">Lesiones</a></li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(auth()->user()->rol === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registro</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4">
    @include('components.alert')
    @yield('content')
</div>

<footer class="text-center py-3 mt-5" style="background:#111;color:#aaa;font-size:.85rem;">
    Gestión Estadística — Valencia CF — 2025/26
</footer>

</body>
</html>