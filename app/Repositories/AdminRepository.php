<?php

namespace App\Repositories;

use App\Models\AdminMenuSection;
use App\Models\Film;
use App\Models\Hall;
use Illuminate\Database\Eloquent\Collection;

class AdminRepository extends Repository
{
    public function getMenuSections(): Collection
    {
        return AdminMenuSection::query()
            ->get(['id', 'name']);
    }

    public function getHalls(): Collection
    {
        return Hall::query()
            ->get(['id', 'name', 'vip_seat_price', 'standard_seat_price']);
    }

    public function getFilms(): Collection
    {
        return Film::query()
            ->with('seances.hall')
            ->get(['id', 'name', 'description', 'duration']);
    }
}