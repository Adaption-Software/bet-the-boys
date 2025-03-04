<?php

namespace Database\Factories;

use App\Enums\Outcome;
use App\Enums\OverUnder;
use App\Models\Bet;
use App\Models\Event;
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
            'winning_team_id' => $this->faker->numberBetween(1, 10),
            'over_under' => $this->faker->randomElement([OverUnder::Over, OverUnder::Under])->value,
            'outcome' => $this->faker->randomElement([Outcome::Win, Outcome::Lose, Outcome::Draw])->value,
        ];
    }
}
