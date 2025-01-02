<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EC extends Model
{
    public function ue()
{
    return $this->belongsTo(UE::class);
}
}
