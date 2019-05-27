<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class HallSeatSetting extends Model
{
    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function seat(): BelongsTo
    {
        return $this->belongsTo(Seat::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->where('is_vip', false);
    }

    public function scopeInactive(Builder $query): Builder
    {
        return $query
            ->where('is_active', false)
            ->where('is_vip', false);
    }

    public function scopeVip(Builder $query): Builder
    {
        return $query
            ->where('is_active', true)
            ->where('is_vip', true);
    }
}