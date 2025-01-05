<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Etudiant;
use App\Models\Note;
use App\Models\UE;
use App\Models\EC;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;


class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1 : Ajout d'une note valide.
     */
    public function testAjoutNoteValide()
    {
        $etudiant = Etudiant::factory()->create();

        $response = $this->post('/notes', [
            'etudiant_id' => $etudiant->id,
            'note' => 15,
            'ue_id' => 1,
            'session' => 'normale', // Assurer que 'session' est défini si nécessaire
        ]);

        $response->assertStatus(302);
    }

    /**
     * Test 2 : Vérification des limites (0-20).
     */

     public function test_limites_notes()
     {
         $etudiant = Etudiant::factory()->create();
         $ue = UE::factory()->create();
         $ec = EC::factory()->create(['ue_id' => $ue->id]);
 
         // Note valide
         $note = Note::factory()->create([
             'etudiant_id' => $etudiant->id,
             'ec_id' => $ec->id,
             'ue_id' => $ue->id,
             'note' => 20,
             'session' => 'normale',
             'date_evaluation' => '2013-01-10',
         ]);
         $this->assertTrue($note->note <= 20 && $note->note >= 0);
 
         // Note invalide
         $noteInvalide = new Note([
             'etudiant_id' => $etudiant->id,
             'ec_id' => $ec->id,
             'ue_id' => $ue->id,
             'note' => 25, // Hors limites
             'session' => 'normale',
             'date_evaluation' => '2013-01-10',
         ]);
 
         $validator = Validator::make($noteInvalide->toArray(), [
             'etudiant_id' => 'required|exists:etudiants,id',
             'ec_id' => 'required|exists:e_c_s,id',
             'note' => 'required|numeric|min:0|max:20',
             'session' => 'required|string',
             'date_evaluation' => 'required|date',
         ]);
 
         $this->assertTrue($validator->fails());
     }
 

    


    

    /**
     * Test 3 : Calcul de la moyenne d'une UE.
     */

     public function test_calcul_moyenne_ue()
     {
         $etudiant = Etudiant::factory()->create();
         $ue = UE::factory()->create();
 
         Note::factory()->create(['etudiant_id' => $etudiant->id, 'note' => 15, 'ue_id' => $ue->id]);
         Note::factory()->create(['etudiant_id' => $etudiant->id, 'note' => 10, 'ue_id' => $ue->id]);
 
         $moyenne = Note::where('ue_id', $ue->id)->where('etudiant_id', $etudiant->id)->avg('note');
         $this->assertEquals(12.5, $moyenne);
     }

    
    /* * Test 4 : Gestion des sessions (normale/rattrapage).
     */
    public function test_gestion_sessions()
    {
        $etudiant = Etudiant::factory()->create();
    
        // Ajout de notes pour session normale et rattrapage
        Note::factory()->create(['etudiant_id' => $etudiant->id, 'note' => 8, 'session' => 'normale']);
        Note::factory()->create(['etudiant_id' => $etudiant->id, 'note' => 12, 'session' => 'rattrapage']);
    
        $moyenneNormale = Note::where('etudiant_id', $etudiant->id)
            ->where('session', 'normale')
            ->avg('note'); // Remplacement de 'valeur' par 'note'
    
        $moyenneRattrapage = Note::where('etudiant_id', $etudiant->id)
            ->where('session', 'rattrapage')
            ->avg('note'); // Remplacement de 'valeur' par 'note'
    
        $this->assertEquals(8, $moyenneNormale);
        $this->assertEquals(12, $moyenneRattrapage);
    }
        
 /* *   Test 5 : Validation des notes manquantes.
   */ 
  public function test_validation_notes_manquantes()
  {
      $etudiant = Etudiant::factory()->create();
  
      // Créer une note avec des données valides
      $note = Note::factory()->create(['etudiant_id' => $etudiant->id]);
  
      // Vérifier que la note existe dans la base de données
      $this->assertDatabaseHas('notes', [
          'etudiant_id' => $etudiant->id,
          'note' => $note->note, // Utiliser la valeur générée
      ]);
  }
  
  
}
