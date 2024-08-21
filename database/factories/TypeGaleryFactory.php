<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TypeGalery>
 */
class TypeGaleryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $facilityTypes = [
            'Facilities',
            'Buildings',
            'Landmarks',
            'Events',
            'Activities',
            'Landscapes',
            'Infrastructure',
        ];

        $type = $this->faker->randomElement($facilityTypes);

        return [
            'id' => Str::uuid(),
            'name' => $type,
            'created_at' => now(),
            'updated_at' => now(),
        ];

    }
}
