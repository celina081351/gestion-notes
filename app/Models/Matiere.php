<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Matiere extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_matiere';

    protected $fillable = [
        'libelle',
        'coefficient',
        'professeur',
    ];

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'id_matiere', 'id_matiere');
    }
}
