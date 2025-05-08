<?php

namespace Tests\Unit;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_get_all_users_in_group(): void
    {
        // Arrange
        $count = random_int(3, 5);

        $groupLeader = User::factory()->create();
        $group = Group::factory()
            ->recycle($groupLeader)
            ->hasAttached(User::factory($count)) // the factory can attach pivot records with this method
            ->create();

        // Act & Assert
        $this->assertCount($count, $group->users);
        $this->assertInstanceOf(Collection::class, $group->users);
        $this->assertContainsOnlyInstancesOf(User::class, $group->users);
        $this->assertDatabaseCount('users', $count + 1);
        $this->assertDatabaseCount('group_users', $count);
        $this->assertDatabaseCount('groups', 1);
    }
}
