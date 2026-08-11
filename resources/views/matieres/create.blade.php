@extends('layouts.app')

@section('title', 'Nouvelle matière')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-success text-white">
                <i class="bi bi-book-fill me-2"></i>Ajouter une matière
            </div>
            <div class="card-body">
                <form action="{{ route('matieres.store') }}" method="POST">
                    @csrf
                    @include('matieres._form')
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i>Enregistrer
                        </button>
                        <a href="{{ route('matieres.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
