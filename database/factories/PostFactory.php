<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'image_path' => $this->faker->imageUrl,

            'category_id' => Category::query()->inRandomOrder()->first()->id,
        ];
    }
}
