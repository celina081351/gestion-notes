<?php

namespace Tests\Feature;

use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    public function test_liste_notes_accessible(): void
    {
        $response = $this->get(route('notes.index'));
        $response->assertStatus(200);
        $response->assertViewIs('notes.index');
    }

    public function test_saisie_note_valide(): void
    {
        $etudiant = Etudiant::factory()->create();
        $matiere  = Matiere::factory()->create();

        $response = $this->post(route('notes.store'), [
            'id_etudiant' => $etudiant->id_etudiant,
            'id_matiere'  => $matiere->id_matiere,
            'valeur'      => 14.5,
            'date_saisie' => '2024-06-10',
            'semestre'    => 'S2',
        ]);

        $response->assertRedirect(route('notes.index'));
        $this->assertDatabaseHas('notes', [
            'id_etudiant' => $etudiant->id_etudiant,
            'id_matiere'  => $matiere->id_matiere,
            'valeur'      => 14.5,
        ]);
    }

    public function test_note_doit_etre_entre_0_et_20(): void
    {
        $etudiant = Etudiant::factory()->create();
        $matiere  = Matiere::factory()->create();

        $payload = [
            'id_etudiant' => $etudiant->id_etudiant,
            'id_matiere'  => $matiere->id_matiere,
            'date_saisie' => '2024-06-10',
            'semestre'    => 'S1',
        ];

        $this->post(route('notes.store'), array_merge($payload, ['valeur' => -1]))
             ->assertSessionHasErrors('valeur');

        $this->post(route('notes.store'), array_merge($payload, ['valeur' => 21]))
             ->assertSessionHasErrors('valeur');
    }

    public function test_etudiant_inexistant_rejete(): void
    {
        $matiere = Matiere::factory()->create();

        $response = $this->post(route('notes.store'), [
            'id_etudiant' => 9999,
            'id_matiere'  => $matiere->id_matiere,
            'valeur'      => 12,
            'date_saisie' => '2024-06-10',
            'semestre'    => 'S1',
        ]);

        $response->assertSessionHasErrors('id_etudiant');
    }

    public function test_calcul_moyenne_ponderee(): void
    {
        $etudiant = Etudiant::factory()->create();
        $m1       = Matiere::factory()->create(['coefficient' => 2]);
        $m2       = Matiere::factory()->create(['coefficient' => 3]);

        Note::factory()->create(['id_etudiant' => $etudiant->id_etudiant, 'id_matiere' => $m1->id_matiere, 'valeur' => 10]);
        Note::factory()->create(['id_etudiant' => $etudiant->id_etudiant, 'id_matiere' => $m2->id_matiere, 'valeur' => 15]);

        // Moyenne pondérée = (10*2 + 15*3) / (2+3) = (20+45)/5 = 13
        $this->assertEquals(13.0, $etudiant->fresh()->moyenne);
    }

    public function test_suppression_note(): void
    {
        $note = Note::factory()->create();

        $response = $this->delete(route('notes.destroy', $note));
        $response->assertRedirect(route('notes.index'));
        $this->assertDatabaseMissing('notes', ['id_note' => $note->id_note]);
    }
}
