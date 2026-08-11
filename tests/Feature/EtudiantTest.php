<?php

namespace Tests\Feature;

use App\Models\Etudiant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EtudiantTest extends TestCase
{
    use RefreshDatabase;

    private array $validData = [
        'nom'            => 'Kanga',
        'prenom'         => 'Junior',
        'email'          => 'junior.kanga@test.com',
        'date_naissance' => '2000-05-15',
        'classe'         => 'L3 INFO',
    ];

    public function test_liste_etudiants_accessible(): void
    {
        $response = $this->get(route('etudiants.index'));
        $response->assertStatus(200);
        $response->assertViewIs('etudiants.index');
    }

    public function test_formulaire_creation_accessible(): void
    {
        $response = $this->get(route('etudiants.create'));
        $response->assertStatus(200);
    }

    public function test_enregistrement_etudiant_valide(): void
    {
        $response = $this->post(route('etudiants.store'), $this->validData);

        $response->assertRedirect(route('etudiants.index'));
        $this->assertDatabaseHas('etudiants', [
            'nom'    => 'Kanga',
            'prenom' => 'Junior',
            'email'  => 'junior.kanga@test.com',
        ]);
    }

    public function test_email_doit_etre_unique(): void
    {
        Etudiant::factory()->create(['email' => 'junior.kanga@test.com']);

        $response = $this->post(route('etudiants.store'), $this->validData);
        $response->assertSessionHasErrors('email');
    }

    public function test_champs_obligatoires(): void
    {
        $response = $this->post(route('etudiants.store'), []);
        $response->assertSessionHasErrors(['nom', 'prenom', 'email', 'date_naissance', 'classe']);
    }

    public function test_modification_etudiant(): void
    {
        $etudiant = Etudiant::factory()->create();

        $response = $this->put(route('etudiants.update', $etudiant), [
            'nom'            => 'Dupont',
            'prenom'         => 'Marie',
            'email'          => 'marie.dupont@test.com',
            'date_naissance' => '1999-03-20',
            'classe'         => 'M1 INFO',
        ]);

        $response->assertRedirect(route('etudiants.index'));
        $this->assertDatabaseHas('etudiants', ['nom' => 'Dupont', 'prenom' => 'Marie']);
    }

    public function test_suppression_etudiant(): void
    {
        $etudiant = Etudiant::factory()->create();

        $response = $this->delete(route('etudiants.destroy', $etudiant));

        $response->assertRedirect(route('etudiants.index'));
        $this->assertDatabaseMissing('etudiants', ['id_etudiant' => $etudiant->id_etudiant]);
    }
}
