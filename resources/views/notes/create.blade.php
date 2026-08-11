@extends('layouts.app')

@section('title', 'Saisir une note')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <i class="bi bi-pencil-fill me-2"></i>Saisie d'une note
            </div>
            <div class="card-body">
                <form action="{{ route('notes.store') }}" method="POST">
                    @csrf
                    @include('notes._form')
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save me-1"></i>Enregistrer
                        </button>
                        <a href="{{ route('notes.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
