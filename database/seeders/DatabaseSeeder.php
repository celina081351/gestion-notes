<?php

namespace Database\Seeders;

use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Note;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $matieres = collect([
            ['libelle' => 'Algorithmique',         'coefficient' => 3, 'professeur' => 'Dr. Martin'],
            ['libelle' => 'Bases de données',      'coefficient' => 4, 'professeur' => 'Prof. Dupont'],
            ['libelle' => 'Réseaux informatiques', 'coefficient' => 2, 'professeur' => 'Dr. Leclerc'],
            ['libelle' => 'Développement web',     'coefficient' => 3, 'professeur' => 'Prof. Moreau'],
            ['libelle' => 'Mathématiques',         'coefficient' => 2, 'professeur' => 'Dr. Bernard'],
        ])->map(fn($d) => Matiere::create($d));

        $etudiants = Etudiant::factory(10)->create();

        foreach ($etudiants as $etudiant) {
            foreach ($matieres as $matiere) {
                Note::create([
                    'id_etudiant' => $etudiant->id_etudiant,
                    'id_matiere'  => $matiere->id_matiere,
                    'valeur'      => round(rand(600, 2000) / 100, 2),
                    'date_saisie' => now()->subDays(rand(1, 90))->format('Y-m-d'),
                    'semestre'    => 'S1',
                ]);
            }
        }

        $this->command->info('✅ Base de données peuplée : 10 étudiants, 5 matières, 50 notes.');
    }
}
