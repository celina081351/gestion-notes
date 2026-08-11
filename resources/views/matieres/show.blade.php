@extends('layouts.app')

@section('title', $matiere->libelle)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book-fill me-2"></i>{{ $matiere->libelle }}</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('matieres.edit', $matiere) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="{{ route('matieres.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">Détails</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Coefficient :</strong>
                    <span class="badge bg-info text-dark fs-6">{{ $matiere->coefficient }}</span>
                </li>
                <li class="list-group-item"><strong>Professeur :</strong> {{ $matiere->professeur }}</li>
                <li class="list-group-item"><strong>Notes saisies :</strong> {{ $matiere->notes->count() }}</li>
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-list-check me-2"></i>Notes des étudiants
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Étudiant</th>
                            <th>Note</th>
                            <th>Semestre</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($matiere->notes as $note)
                        <tr>
                            <td>{{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}</td>
                            <td>
                                <span class="badge bg-{{ $note->valeur >= 10 ? 'success' : 'danger' }}">
                                    {{ $note->valeur }}/20
                                </span>
                            </td>
                            <td>{{ $note->semestre }}</td>
                            <td>{{ $note->date_saisie->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-muted text-center">Aucune note.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
