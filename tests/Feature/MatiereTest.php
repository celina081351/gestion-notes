<?php

namespace Tests\Feature;

use App\Models\Matiere;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MatiereTest extends TestCase
{
    use RefreshDatabase;

    private array $validData = [
        'libelle'     => 'Algorithmique',
        'coefficient' => 3,
        'professeur'  => 'Dr. Martin',
    ];

    public function test_liste_matieres_accessible(): void
    {
        $response = $this->get(route('matieres.index'));
        $response->assertStatus(200);
        $response->assertViewIs('matieres.index');
    }

    public function test_creation_matiere_valide(): void
    {
        $response = $this->post(route('matieres.store'), $this->validData);

        $response->assertRedirect(route('matieres.index'));
        $this->assertDatabaseHas('matieres', ['libelle' => 'Algorithmique', 'coefficient' => 3]);
    }

    public function test_coefficient_doit_etre_entre_1_et_10(): void
    {
        $response = $this->post(route('matieres.store'), array_merge($this->validData, ['coefficient' => 0]));
        $response->assertSessionHasErrors('coefficient');

        $response = $this->post(route('matieres.store'), array_merge($this->validData, ['coefficient' => 11]));
        $response->assertSessionHasErrors('coefficient');
    }

    public function test_champs_obligatoires(): void
    {
        $response = $this->post(route('matieres.store'), []);
        $response->assertSessionHasErrors(['libelle', 'coefficient', 'professeur']);
    }

    public function test_suppression_matiere(): void
    {
        $matiere = Matiere::factory()->create();

        $response = $this->delete(route('matieres.destroy', $matiere));

        $response->assertRedirect(route('matieres.index'));
        $this->assertDatabaseMissing('matieres', ['id_matiere' => $matiere->id_matiere]);
    }
}
