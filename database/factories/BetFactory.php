<?php

namespace Database\Factories;

use App\Enums\Outcome;
use App\Enums\OverUnder;
use App\Enums\OverUnderResult;
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
            'over_under_team_id' => Team::factory(),
            'over_under' => $this->faker->randomElement([OverUnder::Over, OverUnder::Under]),
            'over_under_result' => $this->faker->randomElement([OverUnderResult::Hit, OverUnderResult::Miss])
        ];
    }
}
