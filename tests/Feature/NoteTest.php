<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Etudiant;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1 : Ajout d'une note valide.
     */
    public function test_ajout_note_valide()
    {
        $etudiant = Etudiant::factory()->create();
        $note = Note::factory()->create([
            'etudiant_id' => $etudiant->id,
            'valeur' => 15,
            'session' => 'normale',
        ]);

        $this->assertDatabaseHas('notes', [
            'etudiant_id' => $etudiant->id,
            'valeur' => 15,
            'session' => 'normale',
        ]);
    }

    /**
     * Test 2 : Vérification des limites (0-20).
     */
    public function test_limites_notes()
    {
        $etudiant = Etudiant::factory()->create();

        // Note valide
        $note = Note::factory()->create([
            'etudiant_id' => $etudiant->id,
            'valeur' => 20,
        ]);
        $this->assertTrue($note->valeur <= 20 && $note->valeur >= 0);

        // Note invalide
        $this->expectException(\Illuminate\Database\QueryException::class);
        Note::factory()->create([
            'etudiant_id' => $etudiant->id,
            'valeur' => 25, // Hors limites
        ]);
    }

    /**
     * Test 3 : Calcul de la moyenne d'une UE.
     */
    public function test_calcul_moyenne_ue()
    {
        $etudiant = Etudiant::factory()->create();
        Note::factory()->create(['etudiant_id' => $etudiant->id, 'valeur' => 15, 'ue_id' => 1]);
        Note::factory()->create(['etudiant_id' => $etudiant->id, 'valeur' => 10, 'ue_id' => 1]);

        $moyenne = Note::where('ue_id', 1)->where('etudiant_id', $etudiant->id)->avg('valeur');
        $this->assertEquals(12.5, $moyenne);
    }

    /**
     * Test 4 : Gestion des sessions (normale/rattrapage).
     */
    public function test_gestion_sessions()
    {
        $etudiant = Etudiant::factory()->create();

        // Ajout de notes pour session normale et rattrapage
        Note::factory()->create(['etudiant_id' => $etudiant->id, 'valeur' => 8, 'session' => 'normale']);
        Note::factory()->create(['etudiant_id' => $etudiant->id, 'valeur' => 12, 'session' => 'rattrapage']);

        $moyenneNormale = Note::where('etudiant_id', $etudiant->id)->where('session', 'normale')->avg('valeur');
        $moyenneRattrapage = Note::where('etudiant_id', $etudiant->id)->where('session', 'rattrapage')->avg('valeur');

        $this->assertEquals(8, $moyenneNormale);
        $this->assertEquals(12, $moyenneRattrapage);
    }

    /**
     * Test 5 : Validation des notes manquantes.
     */
    public function test_validation_notes_manquantes()
    {
        $etudiant = Etudiant::factory()->create();
        Note::factory()->create(['etudiant_id' => $etudiant->id, 'valeur' => null]);

        $noteManquante = Note::where('etudiant_id', $etudiant->id)->whereNull('valeur')->exists();
        $this->assertTrue($noteManquante);
    }
}
