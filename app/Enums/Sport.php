<?php

namespace App\Enums;

enum Sport: string
{
    case Basketball = 'basketball';

    case Football = 'football';

    public function label(): string
    {
        return match ($this) {
            self::Basketball => 'Basketball',
            self::Football => 'Football',
        };
    }

    public function endpoint(): string
    {
        return match ($this) {
            self::Football => 'americanfootball_nfl',
            self::Basketball => 'basketball_nba',
        };
    }
}
