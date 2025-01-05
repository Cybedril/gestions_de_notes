<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Etudiant;
use App\Models\EC;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotesTest extends TestCase
{
    use RefreshDatabase;

    public function test_ajout_note_valide()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = EC::factory()->create();
        
        $note = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15,
            'session' => 'normale',
        ]);

        $this->assertDatabaseHas('notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15,
        ]);
    }

    public function test_verification_limites()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = EC::factory()->create();

        $noteMin = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 0,
            'session' => 'normale',
        ]);
        
        $noteMax = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 20,
            'session' => 'normale',
        ]);

        $this->assertDatabaseHas('notes', [
            'note' => 0
        ]);
        
        $this->assertDatabaseHas('notes', [
            'note' => 20
        ]);
    }

    public function test_calcul_moyenne_ue()
    {
        $etudiant = Etudiant::factory()->create();
        $ec1 = EC::factory()->create();
        $ec2 = EC::factory()->create();
        
        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec1->id,
            'note' => 12,
            'session' => 'normale',
        ]);
        
        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec2->id,
            'note' => 14,
            'session' => 'normale',
        ]);

        $moyenne = ($ec1->coefficient * 12 + $ec2->coefficient * 14) / ($ec1->coefficient + $ec2->coefficient);
        
        $this->assertEquals(13, $moyenne);
    }

    public function test_gestion_sessions()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = EC::factory()->create();
        
        // Session normale
        $noteNormale = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 15,
            'session' => 'normale',
        ]);

        // Session de rattrapage
        $noteRattrapage = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 18,
            'session' => 'rattrapage',
        ]);

        $this->assertDatabaseHas('notes', [
            'session' => 'normale',
            'note' => 15,
        ]);

        $this->assertDatabaseHas('notes', [
            'session' => 'rattrapage',
            'note' => 18,
        ]);
    }

    public function test_validation_notes_manquantes()
    {
        $etudiant = Etudiant::factory()->create();
        $ec = EC::factory()->create();

        $note = Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => null,
            'session' => 'normale',
        ]);

        $this->assertDatabaseHas('notes', [
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => null,
        ]);
    }
}
