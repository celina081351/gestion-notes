@extends('layouts.app')

@section('title', 'Matières')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-book-fill me-2"></i>Matières</h2>
    <a href="{{ route('matieres.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i>Nouvelle matière
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Coefficient</th>
                    <th>Professeur</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matieres as $matiere)
                <tr>
                    <td>{{ $matiere->id_matiere }}</td>
                    <td><strong>{{ $matiere->libelle }}</strong></td>
                    <td><span class="badge bg-info text-dark">{{ $matiere->coefficient }}</span></td>
                    <td>{{ $matiere->professeur }}</td>
                    <td class="text-end">
                        <a href="{{ route('matieres.show', $matiere) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('matieres.edit', $matiere) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('matieres.destroy', $matiere) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cette matière ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted py-4">Aucune matière enregistrée.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $matieres->links() }}</div>
@endsection
