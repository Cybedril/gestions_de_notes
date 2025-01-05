<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UE;
use App\Models\EC;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ECTest extends TestCase
{
    use RefreshDatabase;

    // Test de création d'un EC avec un coefficient
    public function test_creation_ec_avec_coefficient()
    {
        $ue = UE::create([
            'code' => 'UE15',
            'nom' => 'Algorithmique',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $ec = EC::create([
            'code' => 'EC15',
            'coefficient' => 3,
            'ue_id' => $ue->id,
        ]);

        $this->assertDatabaseHas('elements_constitutifs', [
            'code' => 'EC15',
            'coefficient' => 3
        ]);
    }

    // Vérification du rattachement d'un EC à une UE
    public function test_rattachement_ec_ue()
    {
        $ue = UE::create([
            'code' => 'UE16',
            'nom' => 'Bases de Données',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $ec = EC::create([
            'code' => 'EC16',
            'coefficient' => 2,
            'ue_id' => $ue->id,
            
        ]);

        $this->assertEquals($ec->ue->id, $ue->id);
    }

    // Test de modification d'un EC
    public function test_modification_ec()
    {
        $ue = UE::create([
            'code' => 'UE17',
            'nom' => 'Développement Mobile',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $ec = EC::create([
            'code' => 'EC17',
            'coefficient' => 3,
            'ue_id' => $ue->id,
        ]);

        $ec->update([
            'coefficient' => 4,
        ]);

        $this->assertDatabaseHas('elements_constitutifs', [
            'code' => 'EC17',
            'coefficient' => 4
        ]);
    }

    // Validation du coefficient (entre 1 et 5)
    public function test_validation_coefficient()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        EC::create([
            'code' => 'EC18',
            'coefficient' => 6,  // Coefficient invalide (au-delà de la plage autorisée)
            'ue_id' => 1,  // UE existante
        ]);
    }

    // Test de suppression d'un EC
    public function test_suppression_ec()
    {
        $ue = UE::create([
            'code' => 'UE19',
            'nom' => 'Architecture',
            'credits_ects' => 6,
            'semestre' => 1,
        ]);

        $ec = EC::create([
            'code' => 'EC19',
            'coefficient' => 2,
            'ue_id' => $ue->id,
        ]);

        $ec->delete();

        $this->assertDatabaseMissing('elements_constitutifs', [
            'code' => 'EC19',
        ]);
    }
}
