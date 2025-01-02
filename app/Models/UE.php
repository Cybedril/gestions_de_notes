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
}
