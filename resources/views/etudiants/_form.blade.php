<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nom <span class="text-danger">*</span></label>
        <input type="text" name="nom" class="form-control @error('nom') is-invalid @enderror"
               value="{{ old('nom', $etudiant->nom ?? '') }}" required>
        @error('nom')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Prénom <span class="text-danger">*</span></label>
        <input type="text" name="prenom" class="form-control @error('prenom') is-invalid @enderror"
               value="{{ old('prenom', $etudiant->prenom ?? '') }}" required>
        @error('prenom')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $etudiant->email ?? '') }}" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Classe <span class="text-danger">*</span></label>
        <input type="text" name="classe" class="form-control @error('classe') is-invalid @enderror"
               value="{{ old('classe', $etudiant->classe ?? '') }}" placeholder="ex: L1 INFO" required>
        @error('classe')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Date de naissance <span class="text-danger">*</span></label>
        <input type="date" name="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror"
               value="{{ old('date_naissance', isset($etudiant) ? $etudiant->date_naissance->format('Y-m-d') : '') }}" required>
        @error('date_naissance')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
