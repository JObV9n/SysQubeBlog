<?php

namespace Database\Factories;

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
            'title'=>$this->faker->title(),
            'slug'=>$this->faker->slug(),
            'description'=>$this->faker->paragraph(12),
            'blog_image'=>$this->faker->imageUrl('https://images.pexels.com/photos/262508/pexels-photo-262508.jpeg?auto=compress&cs=tinysrgb&w=600'),
            'status'=>$this->faker->randomElement(['Published','Draft']),
        ];
    }
}
