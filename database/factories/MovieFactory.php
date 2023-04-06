<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->word(),
            'length' => fake()->numberBetween(60,240),
            'release_date' => fake()->date(),
            'overview' => fake()->text(2024),
            'poster_url' => fake()->url(),
            'tmdb_vote_avarage' => fake()->randomFloat(3,0,10),
            'tmdb_vote_count' => fake()->numberBetween(0,2000000),
            'tmdb_url' => fake()->url(),
        ];
    }
}
