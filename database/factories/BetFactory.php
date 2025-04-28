<?php

namespace Database\Factories;

use App\Enums\Outcome;
use App\Enums\SpreadBet;
use App\Enums\SpreadBetResult;
use App\Models\Bet;
use App\Models\Event;
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
            'event_id' => Event::factory(),
            'winning_team_id' => Team::factory(),
            'outcome' => $this->faker->randomElement([Outcome::Win, Outcome::Lose, Outcome::Draw]),
            'spread_bet_team_id' => Team::factory(),
            'spread_bet' => $this->faker->randomElement([SpreadBet::Over, SpreadBet::Under]),
            'spread_bet_result' => $this->faker->randomElement([SpreadBetResult::Hit, SpreadBetResult::Miss]),
        ];
    }
}
