<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class AdminMenuSection extends Model
{
    const HALL_MANAGEMENT = 'Управление залами';
    const HALL_SEAT_CONFIG = 'Конфигурация залов';
    const HALL_SEAT_PRICES = 'Конфигурация цен';
    const SEANCES = 'Сетка сеансов';
    const START_SALES = 'Открыть продажи';

    const MENU_ITEMS = [
        self::HALL_MANAGEMENT,
        self::HALL_SEAT_CONFIG,
        self::HALL_SEAT_PRICES,
        self::SEANCES,
        self::START_SALES,
    ];
}