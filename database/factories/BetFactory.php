<?php

namespace Database\Factories;

use App\Enums\BetType;
use App\Enums\Outcome;
use App\Enums\Sport;
use App\Models\Bet;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bet>
 */
class BetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'event_id' => $this->faker->uuid(),
            'team_id' => Team::factory(),
            'outcome' => $this->faker->randomElement([Outcome::Win, Outcome::Lose, Outcome::Draw]),
            'bet_type' => $this->faker->randomElement([BetType::Over, BetType::Under, BetType::Favorite, BetType::Dawg]),
            'sport' => $this->faker->randomElement([Sport::Football, Sport::Basketball]),
        ];
    }
}
