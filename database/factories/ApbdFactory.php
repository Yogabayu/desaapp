<?php

namespace Database\Factories;

use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apbd>
 */
class ApbdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $village = GeneralInfo::inRandomOrder()->first();

        return [
            'id' => Str::uuid(),
            'village_id' => $village->id,
            'description' => $this->faker->sentence,
            'amount' => $this->faker->numberBetween(1000000, 100000000),
            'date' => now(),
            'type' => $this->faker->numberBetween(1, 3),
        ];
    }
}
