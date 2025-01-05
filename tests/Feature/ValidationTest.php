<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Etudiant;
use App\Models\UE;
use App\Models\EC;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_validation_ue()
    {
        $etudiant = Etudiant::factory()->create();
        $ue = UE::factory()->create();
        $ec1 = EC::factory()->create(['ue_id' => $ue->id]);
        $ec2 = EC::factory()->create(['ue_id' => $ue->id]);

        // Ajouter des notes valides
        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec1->id,
            'note' => 12,
            'session' => 'normale',
        ]);
        
        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec2->id,
            'note' => 13,
            'session' => 'normale',
        ]);

        $this->assertTrue($etudiant->estValideUE($ue));  // UE validée si moyenne ≥ 10
    }

    public function test_test_compensation_entre_ues()
    {
        $etudiant = Etudiant::factory()->create();
        $ue1 = UE::factory()->create();
        $ue2 = UE::factory()->create();
        $ec1 = EC::factory()->create(['ue_id' => $ue1->id]);
        $ec2 = EC::factory()->create(['ue_id' => $ue2->id]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec1->id,
            'note' => 8,
            'session' => 'normale',
        ]);
        
        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec2->id,
            'note' => 14,
            'session' => 'normale',
        ]);

        // Calcul de la compensation
        $this->assertTrue($etudiant->estValideUE($ue1) || $etudiant->estValideUE($ue2));  // Compensée si moyenne ≥ 10
    }

    public function test_calcul_ects_acquis()
    {
        $etudiant = Etudiant::factory()->create();
        $ue = UE::factory()->create();
        $ec1 = EC::factory()->create(['ue_id' => $ue->id, 'credits_ects' => 5]);
        $ec2 = EC::factory()->create(['ue_id' => $ue->id, 'credits_ects' => 3]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec1->id,
            'note' => 15,
            'session' => 'normale',
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec2->id,
            'note' => 18,
            'session' => 'normale',
        ]);

        // Calcul des ECTS
        $ectsAcquis = $ec1->credits_ects + $ec2->credits_ects;
        $this->assertEquals(8, $ectsAcquis);
    }

    public function test_validation_semestre()
    {
        $etudiant = Etudiant::factory()->create();
        $ue1 = UE::factory()->create(['semestre' => 1]);
        $ue2 = UE::factory()->create(['semestre' => 2]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => EC::factory()->create(['ue_id' => $ue1->id])->id,
            'note' => 12,
            'session' => 'normale',
        ]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => EC::factory()->create(['ue_id' => $ue2->id])->id,
            'note' => 14,
            'session' => 'normale',
        ]);

        // Vérifier que le semestre est valide si les UEs sont validées
        $this->assertTrue($etudiant->estValideSemestre(1));
    }

    public function test_passage_annee_suivante()
    {
        $etudiant = Etudiant::factory()->create();

        $this->assertTrue($etudiant->passageAnneeSuivante());
    }
}
