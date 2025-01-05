<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UE;
use App\Models\Etudiant;
use App\Models\EC;
use App\Models\Note;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UETest extends TestCase
{
    use RefreshDatabase;

    // Test de création d'une UE valide
    public function test_creation_ue()
    {
        $ue = UE::create([
            'code' => 'UE11',
            'nom' => 'Programmation Web',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $this->assertDatabaseHas('unites_enseignement', [
            'code' => 'UE11'
        ]);
    }

    // Vérification des crédits ECTS (entre 1 et 30)
    public function test_credits_ects_valides()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        UE::create([
            'code' => 'UE12',
            'nom' => 'Mathématiques',
            'credits_ects' => 35,  // Crédits invalides (au-delà de la plage autorisée)
            'semestre' => 1,
        ]);
    }

    public function test_credits_ects_minimum()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        UE::create([
            'code' => 'UE13',
            'nom' => 'Informatique Avancée',
            'credits_ects' => 0,  // Crédits invalides (en dessous de 1)
            'semestre' => 1,
        ]);
    }

    // Test d'association des ECs à une UE
    public function test_association_ec_a_ue()
    {
        $ue = UE::create([
            'code' => 'UE14',
            'nom' => 'Réseaux',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $ec = EC::create([
            'code' => 'EC14',
            'coefficient' => 2,
            'ue_id' => $ue->id,
        ]);

        $this->assertTrue($ue->ecs->contains($ec));
    }

    // Validation du code UE (format UExx)
    public function test_validation_code_ue()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        UE::create([
            'code' => 'UE123',  // Code incorrect
            'nom' => 'Systèmes',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);
    }

    // Vérification du semestre
    public function test_semestre_valide()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        UE::create([
            'code' => 'UE15',
            'nom' => 'Sécurité Informatique',
            'credits_ects' => 6,
            'semestre' => 5,  // Semestre invalide
        ]);
    }

    // Test de validation d'UE
    public function test_validation_ue()
    {
        $ue = UE::factory()->create();
        $etudiant = Etudiant::factory()->create();
        $ec = EC::factory()->create(['ue_id' => $ue->id, 'coefficient' => 2]);

        Note::create([
            'etudiant_id' => $etudiant->id,
            'ec_id' => $ec->id,
            'note' => 12,
            'session' => 'normale'
        ]);

        $this->assertTrue($ue->estValidee($etudiant));
    }
}
