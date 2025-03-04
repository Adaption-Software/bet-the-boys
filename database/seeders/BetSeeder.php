<?php

namespace Database\Seeders;

use App\Models\Bet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class BetSeeder extends Seeder
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
        Bet::factory(10)
            ->recycle($this->users->random())
            ->create();
    }
}
