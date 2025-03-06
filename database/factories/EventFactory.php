<?php

namespace Database\Factories;

use App\Enums\Outcome;
use App\Models\Event;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    use WithFaker;

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Model>
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'winning_team_id' => Team::factory(),
            'event_date' => $this->faker->date(),
            'outcome' => $this->faker->randomElement([Outcome::Win, Outcome::Lose, Outcome::Draw])->value,
            'cancelled' => $this->faker->boolean(),
        ];
    }
}
