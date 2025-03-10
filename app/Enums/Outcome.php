<?php

namespace App\Enums;

enum Outcome: string
{
    case Win = 'win';
    case Lose = 'lose';
    case Draw = 'draw';

    public function label(): string
    {
        return match ($this) {
            self::Win => 'Win',
            self::Lose => 'Lose',
            self::Draw => 'Draw',
        };
    }
}
