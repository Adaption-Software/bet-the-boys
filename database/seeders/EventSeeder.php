<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Team;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all();

        Event::factory(10)->recycle($teams)->create();
    }
}
