<?php

namespace Tests\Unit;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_get_all_groups_for_user()
    {
        $user = User::factory()->create();
        $groups = Group::factory()->count(2)->create();

        // attach via pivot
        $user->groups()->attach($groups->pluck('id')->toArray());

        $user->load('groups');

        $this->assertCount(2, $user->groups);
        $this->assertEquals(
            $groups->pluck('id')->sort()->values()->toArray(),
            $user->groups->pluck('id')->sort()->values()->toArray()
        );
    }
}
