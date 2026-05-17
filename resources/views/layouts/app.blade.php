<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabinet Médical — @yield('title', 'Tableau de bord')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .sidebar {
            min-height: 100vh;
            background-color: #1a3c5e;
            width: 250px;
            position: fixed;
            top: 0; left: 0;
        }
        .sidebar .nav-link {
            color: #adb5bd;
            padding: 10px 20px;
            border-radius: 6px;
            margin: 2px 10px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #2563a8;
            color: #fff;
        }
        .sidebar .nav-link i { margin-right: 8px; }
        .sidebar-brand {
            color: #fff;
            font-size: 1.2rem;
            font-weight: 700;
            padding: 20px;
            border-bottom: 1px solid #2563a8;
            display: block;
        }
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        .topbar {
            background: #fff;
            padding: 12px 24px;
            border-radius: 10px;
            margin-bottom: 24px;
            box-shadow: 0 1px 4px rgba(0,0,0,.07);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .card { border: none; border-radius: 12px; box-shadow: 0 1px 6px rgba(0,0,0,.08); }
        .card-header { border-radius: 12px 12px 0 0 !important; font-weight: 600; }
    </style>
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar d-flex flex-column">
    <a class="sidebar-brand" href="#">
        <i class="bi bi-heart-pulse-fill me-2"></i> Cabinet Médical
    </a>
    <nav class="nav flex-column mt-3">
        @auth
            @if(auth()->user()->role === 'medecin')
                <a class="nav-link {{ request()->is('medecin*') ? 'active' : '' }}" href="{{ route('medecin.index') }}">
                    <i class="bi bi-person-badge"></i> Mon profil
                </a>
                <a class="nav-link {{ request()->is('patient*') ? 'active' : '' }}" href="{{ route('patient.index') }}">
                    <i class="bi bi-people"></i> Patients
                </a>
                <a class="nav-link {{ request()->is('rendezvous*') ? 'active' : '' }}" href="{{ route('rendezvous.index') }}">
                    <i class="bi bi-calendar-check"></i> Rendez-vous
                </a>
                <a class="nav-link {{ request()->is('dossier*') ? 'active' : '' }}" href="{{ route('dossier.index') }}">
                    <i class="bi bi-folder2-open"></i> Dossiers
                </a>
                <a class="nav-link {{ request()->is('ordonnance*') ? 'active' : '' }}" href="{{ route('ordonnance.index') }}">
                    <i class="bi bi-file-earmark-medical"></i> Ordonnances
                </a>
            @else
                <a class="nav-link {{ request()->is('mon/rendezvous*') ? 'active' : '' }}" href="{{ route('patient.rendezvous') }}">
                    <i class="bi bi-calendar-check"></i> Mes rendez-vous
                </a>
                <a class="nav-link {{ request()->is('mon/dossier*') ? 'active' : '' }}" href="{{ route('patient.dossier') }}">
                    <i class="bi bi-folder2-open"></i> Mon dossier
                </a>
                <a class="nav-link {{ request()->is('mon/ordonnance*') ? 'active' : '' }}" href="{{ route('patient.ordonnance') }}">
                    <i class="bi bi-file-earmark-medical"></i> Mes ordonnances
                </a>
            @endif
        @endauth
    </nav>
    <div class="mt-auto p-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-outline-light w-100 btn-sm">
                <i class="bi bi-box-arrow-left me-1"></i> Déconnexion
            </button>
        </form>
    </div>
</div>

{{-- Contenu principal --}}
<div class="main-content">
    <div class="topbar">
        <h5 class="mb-0 fw-semibold">@yield('title', 'Tableau de bord')</h5>
        <span class="text-muted small">
            <i class="bi bi-person-circle me-1"></i>
            {{ auth()->user()->name ?? '' }}
        </span>
    </div>

    {{-- Messages flash --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>