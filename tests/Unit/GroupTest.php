<?php

namespace Tests\Unit;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Group('users')]
    public function test_users_relationship(): void
    {
        // Arrange
        $count = random_int(3, 5);

        $group = Group::factory()
            ->recycle(User::factory())
            ->hasAttached(User::factory($count))
            ->create();

        // Act & Assert
        $this->assertCount($count, $group->users);
        $this->assertInstanceOf(Collection::class, $group->users);
        $this->assertContainsOnlyInstancesOf(User::class, $group->users);
    }

    #[\PHPUnit\Framework\Attributes\Group('users')]
    public function test_leader_relationship(): void
    {
        $group = Group::factory()->create();

        $this->assertInstanceOf(User::class, $group->leader);
    }
}
