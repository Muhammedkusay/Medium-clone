<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

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
        $title = fake()->sentence();
        return [
            'image' => 'https://picsum.photos/id/' . fake()->numberBetween(100, 200) . '/800/600',
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'content' => fake()->paragraph(),
            'category_id' => Category::inRandomOrder()->first()->id,
            // 'user_id' => User::inRandomOrder()->first()->id(),
            'user_id' => 1,
            'published_at' => fake()->optional()->dateTimeThisYear(),
        ];
    }
}
