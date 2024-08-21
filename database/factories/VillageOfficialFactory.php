<?php

namespace Database\Factories;

use App\Models\GeneralInfo;
use App\Models\VillageOfficial;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VillageOfficial>
 */
class VillageOfficialFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VillageOfficial::class;

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
            'slug' => Str::slug($this->faker->name),
            'village_id' => $village->id,
            'name' => $this->faker->name,
            'position' => $this->faker->jobTitle,
            'image' => $this->faker->imageUrl(640, 480, 'people', true),
        ];
    }
}
