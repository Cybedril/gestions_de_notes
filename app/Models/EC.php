<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EC extends Model
{
    use HasFactory;
    // Table associée
    protected $table = 'elements_constitutifs';  // Assure-toi que le nom de la table est correct


    // Spécifie les colonnes autorisées pour l'insertion en masse
    protected $fillable = [
        'code',
        'nom',
        'coefficient',
        'ue_id',
    ];

    /**
     * Un EC appartient à une UE.
     */

    public function ue()
    {
        return $this->belongsTo(UE::class, 'ue_id');
    }
    public function notes()
{
    return $this->hasMany(Note::class, 'ec_id');
}

}
