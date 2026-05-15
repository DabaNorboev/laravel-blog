<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            'title' => fake()->sentence(),
            'content' => fake()->text(random_int(1500, 3500)),
            'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),
            'image' => fake()->imageUrl(),
            'views' => fake()->numberBetween(1000, 5000),
            'is_published' => true,
            'created_at' => fake()->dateTimeBetween('-3 months', 'now'),
            'updated_at' => function (array $attributes) {
                return fake()->dateTimeBetween($attributes['created_at'], 'now');
            },
            'user_id' => User::inRandomOrder()->value('id') ?? Category::factory(),
        ];
    }
}
