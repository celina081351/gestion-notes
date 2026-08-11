<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gestion des Notes')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,.08); }
        .badge-ci { background-color: #0d6efd; font-size: .7rem; vertical-align: middle; }
        .pipeline-bar { background: linear-gradient(90deg,#198754,#0d6efd,#fd7e14); height: 4px; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="bi bi-mortarboard-fill me-2"></i>GestionNotes
            <span class="badge badge-ci ms-2">CI/CD</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('etudiants.*') ? 'active' : '' }}" href="{{ route('etudiants.index') }}">
                        <i class="bi bi-people-fill me-1"></i>Étudiants
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('matieres.*') ? 'active' : '' }}" href="{{ route('matieres.index') }}">
                        <i class="bi bi-book-fill me-1"></i>Matières
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('notes.*') ? 'active' : '' }}" href="{{ route('notes.index') }}">
                        <i class="bi bi-pencil-fill me-1"></i>Notes
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="pipeline-bar"></div>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @yield('content')
</div>

<footer class="text-center text-muted py-4 mt-5">
    <small>
        <i class="bi bi-git me-1"></i> Intégration · Livraison · Déploiement Continu &nbsp;|&nbsp;
        Pipeline Jenkins &nbsp;|&nbsp; PHP {{ PHP_VERSION }}
    </small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
