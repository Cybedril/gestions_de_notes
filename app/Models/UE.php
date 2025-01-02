<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UE extends Model
{
    public function ecs()
{
    return $this->hasMany(EC::class);
}
}
