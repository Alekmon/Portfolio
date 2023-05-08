<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => Str::random(10),
            'description' => fake()->text(60),
            'image' => str_replace('\\', '/', fake()->image('public/storage/menus', 640, 480, null, false)),
            'price' => rand(0.1, 60),
        ];
    }
}
