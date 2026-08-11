@extends('layouts.app')

@section('title', $etudiant->prenom . ' ' . $etudiant->nom)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-person-circle me-2"></i>{{ $etudiant->prenom }} {{ $etudiant->nom }}</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('etudiants.edit', $etudiant) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">Informations</div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Classe :</strong> {{ $etudiant->classe }}</li>
                <li class="list-group-item"><strong>Email :</strong> {{ $etudiant->email }}</li>
                <li class="list-group-item"><strong>Naissance :</strong> {{ $etudiant->date_naissance->format('d/m/Y') }}</li>
                <li class="list-group-item">
                    <strong>Moyenne générale :</strong>
                    @php $moy = $etudiant->moyenne; @endphp
                    <span class="badge fs-6 bg-{{ $moy >= 10 ? 'success' : 'danger' }}">{{ $moy }}/20</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <i class="bi bi-list-check me-2"></i>Notes ({{ $etudiant->notes->count() }})
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Matière</th>
                            <th>Coeff.</th>
                            <th>Note</th>
                            <th>Semestre</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($etudiant->notes as $note)
                        <tr>
                            <td>{{ $note->matiere->libelle }}</td>
                            <td>{{ $note->matiere->coefficient }}</td>
                            <td>
                                <span class="badge bg-{{ $note->valeur >= 10 ? 'success' : 'danger' }}">
                                    {{ $note->valeur }}/20
                                </span>
                            </td>
                            <td>{{ $note->semestre }}</td>
                            <td>{{ $note->date_saisie->format('d/m/Y') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-muted text-center">Aucune note.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
