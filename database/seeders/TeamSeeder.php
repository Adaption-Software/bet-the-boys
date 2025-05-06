<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path('database/data/nfl_teams.csv'), 'r');

        while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
            $fullName = $data[0];

            Team::create([
                'team_name' => $fullName,
                'short_name' => static::abbreviate($fullName),
            ]);
        }
    }

    public static function abbreviate(string $fullName): string
    {
        preg_match_all('/[A-Z]/', ucwords($fullName), $matches);

        return implode('', $matches[0]);
    }
}
