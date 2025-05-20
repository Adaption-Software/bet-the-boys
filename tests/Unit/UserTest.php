<?php

namespace Tests\Unit;

use App\Models\Bet;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Group('groups')]
    public function test_groups_relationship(): void
    {
        $count = random_int(3, 5);

        $user = User::factory()->create();

        Group::factory($count)
            ->recycle($user)
            ->hasAttached($user)
            ->create();

        $this->assertCount($count, $user->groups);
        $this->assertInstanceOf(Collection::class, $user->groups);
        $this->assertContainsOnlyInstancesOf(Group::class, $user->groups);
    }

    #[\PHPUnit\Framework\Attributes\Group('bets')]
    public function test_bets_relationship(): void
    {
        $count = random_int(3, 5);

        $user = User::factory()
            ->has(Bet::factory($count))
            ->create();

        $this->assertCount($count, $user->bets);
        $this->assertInstanceOf(Collection::class, $user->bets);
        $this->assertContainsOnlyInstancesOf(Bet::class, $user->bets);
    }
}
