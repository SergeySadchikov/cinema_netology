<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    public function seance(): BelongsTo
    {
        return $this->belongsTo(Seance::class);
    }

    public function settings(): BelongsToMany
    {
        return $this->belongsToMany(
            HallSeatSetting::class,
            'hall_seat_ticket_pivot',
            'ticket_id',
            'hall_seat_setting_id'
        );
    }
}