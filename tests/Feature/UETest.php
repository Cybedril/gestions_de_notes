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
            'code' => 'UE001',
            'nom' => 'Mathématiques',
            'credits_ects' => 0,  // Crédits invalides (au-delà de la plage autorisée)
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
    public function testValidationUE()
{
    // Créer un étudiant avec une note suffisante
    $etudiant = Etudiant::factory()->create();

    // Assurez-vous que l'étudiant a des notes suffisantes pour valider l'UE
    $etudiant->notes()->create([
        'valeur' => 12,  // Exemple de note suffisante
        'session' => 'normale',
    ]);

    // Créer l'UE et vérifier si elle est validée
    $ue = UE::factory()->create();
    
    $this->assertTrue($ue->estValidee($etudiant));  // L'UE devrait être validée par l'étudiant
}

}
