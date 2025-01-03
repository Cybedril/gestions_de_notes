<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UE;


class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['numero_etudiant', 'nom', 'prenom', 'niveau'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function creditsAcquis()
{
    $totalCredits = 0;

    foreach (UE::all() as $ue) {
        if ($ue->estValidee($this->id)) {
            $totalCredits += $ue->credits_ects;
        }
    }

    return $totalCredits;
}
public function estCompensee($semestre)
{
    $uesSemestre = UE::where('semestre', $semestre)->get();
    $totalNotes = 0;
    $totalCredits = 0;

    foreach ($uesSemestre as $ue) {
        $moyenne = $ue->moyenneParEtudiant($this->id); // Assurez-vous que cette méthode existe dans le modèle UE.
        $totalNotes += $moyenne * $ue->credits_ects;
        $totalCredits += $ue->credits_ects;
    }

    return $totalCredits > 0 && ($totalNotes / $totalCredits) >= 10;
}
public function peutPasser()
{
    $creditsRequis = match ($this->niveau) {
        'L1' => 30,
        'L2' => 60,
        'L3' => 90,
        default => 0,
    };

    return $this->creditsAcquis() >= $creditsRequis;
}

}
