<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'content' => $this->faker->paragraph,
            'user_id' => \App\Models\User::factory(), // Create a user for the post
        ];
    }
}