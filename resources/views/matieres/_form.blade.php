<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label">Libellé <span class="text-danger">*</span></label>
        <input type="text" name="libelle" class="form-control @error('libelle') is-invalid @enderror"
               value="{{ old('libelle', $matiere->libelle ?? '') }}" placeholder="ex: Mathématiques" required>
        @error('libelle')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Coefficient <span class="text-danger">*</span></label>
        <input type="number" name="coefficient" class="form-control @error('coefficient') is-invalid @enderror"
               value="{{ old('coefficient', $matiere->coefficient ?? 1) }}" min="1" max="10" required>
        @error('coefficient')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Professeur <span class="text-danger">*</span></label>
        <input type="text" name="professeur" class="form-control @error('professeur') is-invalid @enderror"
               value="{{ old('professeur', $matiere->professeur ?? '') }}" placeholder="Nom du professeur" required>
        @error('professeur')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
