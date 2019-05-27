<?php

namespace App\Http\Resources;

use App\Models\AdminMenuSection;
use App\Models\Film;
use App\Models\Hall;
use App\Models\HallSeatSetting;
use App\Models\Seance;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class AdminResource implements Arrayable
{
    /** @var AdminMenuSection[]|Collection $menuSections*/
    private $menuSections;

    /** @var Hall[]|Collection $halls */
    private $halls;

    /** @var Collection $hallSeatConfig */
    private $hallSeatConfig;

    /** @var Collection $hallSeatPriceConfig */
    private $hallSeatPriceConfig;

    /** @var Film[]|Collection $films */
    private $films;

    /** @var Collection $seancesConfig */
    private $seancesConfig;

    public function __construct(Collection $adminMenuSections, Collection $films, Collection $halls)
    {
        $this->menuSections = $adminMenuSections;
        $this->halls = $halls;
        $this->hallSeatPriceConfig = $halls;
        $this->films = $films;
    }

    public function toArray(): array
    {
        $this->setHallSeatConfig()
            ->setHallSeatPriceConfig()
            ->setSeancesConfig()
            ->setSectionsChildren();

        $this->menuSections = $this->menuSections
            ->map(function (AdminMenuSection $section) {

                /** @var Collection $children */
                 $children = $section->getAttribute('children');

                 $newChildren = new Collection($children);

                 $newChildren = $newChildren
                    ->map(function ($item) {

                        if (is_array($item)) {

                            return $item;
                        }

                        return $this->modelToArray($item);
                    });

                 $section->setAttribute('children', $newChildren->toArray());


                return $this->modelToArray($section);
            })
            ->toArray();

         return $this->menuSections;
    }

    private function setSectionsChildren(): self
    {
        $this->menuSections = $this->menuSections
            ->map(function (AdminMenuSection $section) {
            $clone = clone $section;
            $clone->setAttribute('children', []);

            return $clone;
        })
            ->keyBy('name');

        foreach ($this->menuSections as $section) {
            switch ($section->name) {

                case AdminMenuSection::HALL_MANAGEMENT:
                    $children = $this->halls;
                    $section->setAttribute('children', $children);
                    break;

                case AdminMenuSection::HALL_SEAT_CONFIG:
                    $children = $this->hallSeatConfig;
                    $section->setAttribute('children', $children);
                    break;

                case AdminMenuSection::HALL_SEAT_PRICES:
                    $children = $this->hallSeatPriceConfig;
                    $section->setAttribute('children', $children);
                    break;

                case AdminMenuSection::SEANCES:
                    $children = $this->seancesConfig;
                    $section->setAttribute('children', $children);
                    break;
            }
        }

        return $this;
    }

    private function setHallSeatConfig(): self
    {
       $this->hallSeatConfig = $this->halls
            ->map(function (Hall $hall) {
                $clone = clone $hall;
                $clone->setAttribute('seats', []);

                return $clone;
            })
            ->each(function (Hall $hall) {
                $seats = $hall->getAttribute('seats');

                $seats['active'] = [];
                $seats['inactive'] = [];
                $seats['vip'] = [];

                $hall->settings()
                    ->active()
                    ->get()
                    ->each(function (HallSeatSetting $setting) use (&$seats) {
                        $seats['active'][] = [
                            'id' => $setting->seat->id,
                            'row' => $setting->seat->row,
                            'number' => $setting->seat->seat_number
                        ];
                    });

                $hall->settings()
                    ->inactive()
                    ->get()
                    ->each(function (HallSeatSetting $setting) use (&$seats) {
                        $seats['inactive'][] = [
                            'id' => $setting->seat->id,
                            'row' => $setting->seat->row,
                            'number' => $setting->seat->seat_number
                        ];
                    });
                $hall->settings()
                    ->vip()
                    ->get()
                    ->each(function (HallSeatSetting $setting) use (&$seats) {
                        $seats['vip'][] = [
                            'id' => $setting->seat->id,
                            'row' => $setting->seat->row,
                            'number' => $setting->seat->seat_number
                        ];
                    });

                $hall->setAttribute('seats', $seats);
            });

       return $this;
    }

    private function setSeancesConfig(): self
    {
        $this->seancesConfig = $this->films
            ->map(function (Film $film) {
                $newFilm = clone $film;

                $newSeances = $newFilm->seances
                    ->map(function (Seance $seance) {
                        $newSeance = clone $seance;

                        $newSeance->setAttribute('hall', [
                            'id' => $newSeance->hall->id,
                            'name' => $newSeance->hall->name,
                        ]);

                        return $newSeance->only(['id', 'start_time', 'end_time', 'hall']);
                    })
                    ->toArray();

                $newFilm->setAttribute('seances', $newSeances);

                return $newFilm;
            })

            ->keyBy('name');

        return $this;
    }

    private function setHallSeatPriceConfig(): self
    {
        $this->hallSeatPriceConfig = $this->hallSeatPriceConfig
            ->map(function (Hall $hall) {
               $config = clone $hall;
               $config->setAttribute('price', [
                   'vip' => $hall->vip_seat_price,
                   'standard' => $hall->standard_seat_price,
               ]);
               return $config->only(['id', 'name', 'price']);
            })
        ->keyBy('name');

        return $this;
    }

    private function modelToArray(Model $model): array
    {
        $attributes = $model->attributesToArray();

        return $attributes;
    }
}
