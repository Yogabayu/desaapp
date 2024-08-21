<?php
// TODO: Implement UmkmFactory
namespace Database\Factories;

use App\Models\GeneralInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Umkm>
 */
class UmkmFactory extends Factory
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
            'slug' => $this->faker->slug,
            'name' => $this->faker->name,
            'desc' => $this->faker->text,
            'tlp' => $this->faker->phoneNumber,
            'fb' => $this->faker->url,
            'ig' => $this->faker->url
        ];
    }
}
