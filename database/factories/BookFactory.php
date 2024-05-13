<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'authored_at' => $this->faker->dateTime,
            'published_at' => $this->faker->dateTime,
            'page_count' => $this->faker->numberBetween(200, 1500),
            'original' => $this->faker->boolean,
            'barrowable' => $this->faker->boolean,
        ];
    }
}
