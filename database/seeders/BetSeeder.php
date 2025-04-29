<?php

namespace Database\Seeders;

use App\Models\Bet;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class BetSeeder extends Seeder
{
    protected Collection $users;

    public function __construct()
    {
        $this->users = User::all()->take(3);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        $this->users->each(function ($user) use ($teams) {
            Bet::factory(10)->recycle($user)->recycle($teams)->create();
        });
    }
}
