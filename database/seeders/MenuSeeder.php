<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['name' => 'Dashboard', 'route' => 'dashboard', 'parent_id' => null],
            ['name' => 'Master Data', 'route' => null, 'parent_id' => null],
            ['name' => 'Data User', 'route' => 'user.index', 'parent_id' => 2],
        ];

        Menu::insert($menus);
    }
}
