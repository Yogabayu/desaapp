<?php

namespace Database\Factories;

use App\Models\GeneralInfo;
use App\Models\TypeGalery;
use App\Models\VillageGallery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VillageGallery>
 */
class VillageGalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VillageGallery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $village = GeneralInfo::inRandomOrder()->first();
        $type = TypeGalery::inRandomOrder()->first();

        return [
            'id' => Str::uuid(),
            'village_id' => $village->id,
            'type_gallery_id' => $type->id,
            'name' => $this->faker->name,
            'desc' => $this->faker->text,
            'image' => $this->faker->imageUrl(640, 480, 'people', true),
            'boolean' => $this->faker->boolean
        ];
    }
}
