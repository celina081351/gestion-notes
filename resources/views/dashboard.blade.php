@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<h2 class="mb-4"><i class="bi bi-speedometer2 me-2"></i>Tableau de bord</h2>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Étudiants</h6>
                    <h2 class="mt-1 mb-0">{{ $totalEtudiants }}</h2>
                </div>
                <i class="bi bi-people-fill fs-1 opacity-50"></i>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="{{ route('etudiants.index') }}" class="text-white text-decoration-none small">
                    Voir la liste <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Matières</h6>
                    <h2 class="mt-1 mb-0">{{ $totalMatieres }}</h2>
                </div>
                <i class="bi bi-book-fill fs-1 opacity-50"></i>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="{{ route('matieres.index') }}" class="text-white text-decoration-none small">
                    Voir la liste <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title mb-0">Notes saisies</h6>
                    <h2 class="mt-1 mb-0">{{ $totalNotes }}</h2>
                </div>
                <i class="bi bi-pencil-fill fs-1 opacity-50"></i>
            </div>
            <div class="card-footer bg-transparent border-0">
                <a href="{{ route('notes.index') }}" class="text-white text-decoration-none small">
                    Voir les notes <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-dark text-white">
        <i class="bi bi-diagram-3-fill me-2"></i>Pipeline CI/CD — Intégration · Livraison · Déploiement Continu
    </div>
    <div class="card-body">
        <div class="row text-center g-0">
            @php
            $stages = [
                ['icon'=>'bi-code-slash','label'=>'Code','color'=>'primary','desc'=>'Push sur dépôt Git'],
                ['icon'=>'bi-arrow-right','label'=>'→','color'=>'secondary','desc'=>''],
                ['icon'=>'bi-check2-all','label'=>'Build & Test','color'=>'info','desc'=>'PHPUnit automatique'],
                ['icon'=>'bi-arrow-right','label'=>'→','color'=>'secondary','desc'=>''],
                ['icon'=>'bi-box-seam','label'=>'Livraison','color'=>'warning','desc'=>'Artefact stable'],
                ['icon'=>'bi-arrow-right','label'=>'→','color'=>'secondary','desc'=>''],
                ['icon'=>'bi-rocket-takeoff','label'=>'Déploiement','color'=>'success','desc'=>'Serveur production'],
            ];
            @endphp
            @foreach($stages as $s)
            <div class="col">
                @if($s['label'] !== '→')
                    <div class="p-3">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center bg-{{ $s['color'] }} text-white mb-2" style="width:50px;height:50px">
                            <i class="{{ $s['icon'] }}"></i>
                        </div>
                        <div class="small fw-bold">{{ $s['label'] }}</div>
                        <div class="text-muted" style="font-size:.75rem">{{ $s['desc'] }}</div>
                    </div>
                @else
                    <div class="p-3 pt-4 text-muted fs-4">→</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
