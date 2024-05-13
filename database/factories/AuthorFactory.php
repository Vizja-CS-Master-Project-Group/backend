<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{

    protected $name;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = Str::of($this->name)->explode(' ');

        return [
            'name' => $name->first(),
            'lastname' => $name->last(),
            'about' => $this->faker->text(),
            'birth_date' => $this->faker->dateTime,
            'dead_date' => $this->faker->randomElement([$this->faker->dateTime, null]),
        ];
    }

    /**
     * @param mixed $name
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }
}
