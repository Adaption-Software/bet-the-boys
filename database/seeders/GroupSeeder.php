<?php

namespace Database\Seeders;

use AllowDynamicProperties;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    protected Collection $users;
    function __construct()
    {
        $this->users = User::all();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::factory(10)
            ->recycle($this->users->random())
            ->create();
    }
}
