<?php

namespace App\Enums;

enum SpreadBet: string
{
    case Over = 'over';
    case Under = 'under';

    public function label(): string
    {
        return match ($this) {
            self::Over => 'Over',
            self::Under => 'Under',
        };
    }
}
