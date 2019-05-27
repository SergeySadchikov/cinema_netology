<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class, 'film_id', 'id');
    }
}