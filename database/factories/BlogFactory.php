<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->sentences(3, true),
            'content' => $this->faker->sentence(50, true),
            'featured_image' => $this->faker->image('storage/app/public', 640, 480, null, false),
            'updated_by' => $this->faker->randomNumber(),
            'created_by' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status' => $this->faker->randomElement(['draft', 'published']),

            'category_id' => BlogCategory::factory(),
        ];
    }
}
