<?php

use App\Models\AdminMenuSection;
use Illuminate\Database\Seeder;

class AdminMenuSectionsSeeder extends Seeder
{
    public function run(): void
    {
        foreach (AdminMenuSection::MENU_ITEMS as $menuItemName) {
            factory(AdminMenuSection::class)->create(
                [
                    'name' => $menuItemName,
                ]
            );
        }
    }
}