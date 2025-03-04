<?php


namespace App\Enums;

enum OverUnder: int
{
    case Over = 1;
    case Under = 2;

    public function label(): string
    {
        return match ($this) {
            self::Over => 'Over',
            self::Under => 'Under',
        };
    }
}
