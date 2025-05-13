<?php

namespace Tests\Unit;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_get_all_groups_for_user()
    {
        $count = random_int(3, 5);

        $user = User::factory()->create();
        $groups = Group::factory($count)
            ->recycle($user)
            ->hasAttached($user)
            ->create();

        $this->assertCount($count, $user->groups);
        $this->assertInstanceOf(Collection::class, $user->groups);
        $this->assertDatabaseCount('group_users', $count);
    }
}
