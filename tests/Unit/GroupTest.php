<?php

namespace Tests\Unit;

use App\Models\Group;
use App\Models\User;
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
        $group = Group::factory()->create();
        $users = User::factory()->count(3)->create();

        $group->users()->attach($users->pluck('id')->toArray());

        // Act
        $group->load('users');

        // Assert
        $this->assertCount(3, $group->users);
        $this->assertEquals(
            $users->pluck('id')->sort()->values()->toArray(),
            $group->users->pluck('id')->sort()->values()->toArray()
        );
    }
}
