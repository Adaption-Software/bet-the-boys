<?php

namespace App\Enums;

use App\Http\Integrations\Odds\Requests\BasketballRequest;
use App\Http\Integrations\Odds\Requests\FootballRequest;
use App\Http\Integrations\Scores\Requests\FootballScoresRequest;

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

    public function request(): string
    {
        return match ($this) {
            self::Basketball => BasketballRequest::class,
            self::Football => FootballRequest::class,
        };
    }

    public function scoresRequest(): string
    {
        return match ($this) {
            self::Basketball, self::Football => FootballScoresRequest::class,
        };
    }
}
