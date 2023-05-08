<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $categories = Category::factory(5)->create();

       Menu::factory(12)->create()->each(function($menu) use ($categories) {
            $menu->categories()->attach($categories->random(2));
       });
    }
}
