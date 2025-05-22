<?php

namespace Database\Factories;

use App\Enums\Sport;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_name' => $this->faker->words(3, true),
            'short_name' => $this->faker->randomLetter(),
            'sport' => $this->faker->randomElement([Sport::Football, Sport::Basketball]),
        ];
    }
}
