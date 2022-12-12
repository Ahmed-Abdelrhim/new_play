<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'content' => $this->faker->text(),
            'post_id' => $this->faker->numberBetween(1,100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
