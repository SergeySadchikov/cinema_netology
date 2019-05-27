<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Hall extends Model
{
    public function settings(): HasMany
    {
        return $this->hasMany(HallSeatSetting::class);
    }
}