<?php

namespace Database\Factories;

use App\Models\Admin;
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
    public function definition()
    {
        return [
            'title' => substr($this->faker->text(30), 0, -1),
            'description' => $this->faker->paragraphs(rand(5, 7), true),
            'admin_id' => Admin::all()->random()->id,
        ];
    }
}
