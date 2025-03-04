<?php

namespace App\Enums;

enum Outcome: int
{
    case Win = 1;
    case Lose = 2;
    case Draw = 3;

    public function label(): string
    {
        return match ($this) {
            self::Win => 'win',
            self::Lose => 'lose',
            self::Draw => 'draw',
        };
    }
}
