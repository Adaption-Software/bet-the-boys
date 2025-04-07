<?php

namespace App\Enums;

enum OverUnderResult: string
{
    case Hit = 'hit';
    case Miss = 'miss';

    public function label(): string
    {
        return match ($this) {
            self::Hit => 'Hit',
            self::Miss => 'Miss',
        };
    }
}
