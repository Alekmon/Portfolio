<?php

namespace Database\Factories;

use App\Enums\TableLocation;
use App\Enums\TableStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Столик ' . rand(1, 20),
            'guest_number' => rand(2,6),
            'status' => TableStatus::Доступно,
            'location' => TableLocation::match(rand(1,3)),
        ];
    }
}
