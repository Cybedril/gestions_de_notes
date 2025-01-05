<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UE extends Model
{
    use HasFactory;

    // Table associée
    protected $table = 'unites_enseignement';  // Assure-toi que le nom de la table est correct

    // Spécifie les colonnes autorisées pour l'insertion en masse
    protected $fillable = [
        'code',
        'nom',
        'credits_ects',
        'semestre',
    ];

    /**
     * Une UE peut avoir plusieurs ECs.
     */
    public function ecs()
    {
        return $this->hasMany(EC::class, 'ue_id');
    }
	public function moyenneParEtudiant($etudiantId)
{
    $totalNotes = 0;
    $totalCoefficients = 0;

    foreach ($this->elementsConstitutifs as $ec) {
        $note = $ec->notes()->where('etudiant_id', $etudiantId)->where('session', 'normale')->first();

        if ($note) {
            $totalNotes += $note->note * $ec->coefficient;
            $totalCoefficients += $ec->coefficient;
        }
    }

    return $totalCoefficients > 0 ? $totalNotes / $totalCoefficients : 0;
}
 public function elementsConstitutifs()
{
    return $this->hasMany(EC::class, 'ue_id');
}

public function estValidee($etudiant)
    {
        // Calculez la moyenne des notes de l'étudiant pour cette UE
        $moyenne = $etudiant->calculerMoyenne();

        // Définissez le seuil de validation
        $seuil = 10;  // Exemple de seuil pour validation (peut être différent selon votre logique)

        // Si la moyenne est supérieure ou égale au seuil, l'UE est validée
        return $moyenne >= $seuil;
    }


}
