<?php

namespace App\Enums;

enum BetType: string
{
    case Under = 'under';
    case Over = 'over';
    case Favorite = 'favorite';
    case Dawg = 'dawg';

    public function label(): string
    {
        return match ($this) {
            self::Under => 'Under',
            self::Over => 'Over',
            self::Favorite => 'Favorite',
            self::Dawg => 'Dawg',
        };
    }
}
