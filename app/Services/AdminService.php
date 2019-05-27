<?php

namespace App\Services;

use App\Http\Resources\AdminResource;
use App\Repositories\AdminRepository;
use Illuminate\Support\Collection;

class AdminService extends Service
{
    public function __construct(AdminRepository $adminRepository)
    {
        $this->repository = $adminRepository;
    }

    public function build(): array
    {
        /** @var Collection $menuSections */
        $menuSections = $this->repository->getMenuSections();

        /** @var Collection $halls */
        $halls = $this->repository->getHalls();

        /** @var Collection $films */
        $films = $this->repository->getFilms();

        $resource = new AdminResource($menuSections, $films, $halls);

        return $resource->toArray();
    }
}