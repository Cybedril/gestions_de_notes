<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EC;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['etudiant_id', 'ec_id', 'note', 'session', 'date_evaluation'];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function ec()
    {
        return $this->belongsTo(ElementConstitutif::class, 'ec_id');
    }
}
