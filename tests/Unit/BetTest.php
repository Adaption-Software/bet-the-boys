<?php

use App\Models\Bet;
use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

#[Group('bets')]
class BetTest extends TestCase
{
    use RefreshDatabase;

    #[Group('users')]
    public function test_wager_relationship(): void
    {
        $bet = Bet::factory()->create();

        $this->assertInstanceOf(User::class, $bet->wagerer);
    }

    #[Group('teams')]
    public function test_team_relationship(): void
    {
        $bet = Bet::factory()->create();

        $this->assertInstanceOf(Team::class, $bet->team);
    }
}
