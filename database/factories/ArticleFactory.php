<?php

namespace Database\Factories;

use App\Models\GeneralInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $village = GeneralInfo::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'id' => Str::uuid(),
            'village_id' => $village->id,
            'user_id' => $user->id,
            'title' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->sentence),
            'content' => $this->faker->text,
            'publish_date' => now(),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'people', true),
            'status' => 1
        ];
    }
}
