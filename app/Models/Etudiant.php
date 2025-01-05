<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UE;


class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['numero_etudiant', 'nom', 'prenom', 'niveau','sexe','date_naissance','matricule'];

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

 // Méthode pour vérifier le passage à l'année suivante
 public function passageAnneeSuivante()
 {
     $moyenne = $this->calculerMoyenne();  // Appel à la méthode calculerMoyenne

     if ($moyenne >= 10) {
         $this->niveau += 1;  // Augmente le niveau de l'étudiant
         $this->save();  // Sauvegarde les modifications dans la base de données

         return true;  // Retourne true si l'étudiant passe
     }

     return false;  // Retourne false si l'étudiant ne passe pas
 }

 // Méthode pour calculer la moyenne des notes de l'étudiant
 public function calculerMoyenne()
 {
     // Si vous avez une relation avec un modèle Note, vous pouvez utiliser cette relation pour récupérer les notes de l'étudiant
     $notes = $this->notes;  // Assurez-vous que l'étudiant a une relation avec les notes

     if ($notes->isEmpty()) {
         return 0;  // Retourner 0 si l'étudiant n'a pas de notes
     }

     // Calculer la moyenne des notes
     $somme = $notes->sum('valeur');  // 'valeur' est un exemple de champ dans le modèle Note
     $nombreDeNotes = $notes->count();

     return $somme / $nombreDeNotes;
 }

 

}
