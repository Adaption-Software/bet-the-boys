<?php

namespace App\Enums;

use App\Http\Integrations\Odds\Requests\BasketballRequest;
use App\Http\Integrations\Odds\Requests\FootballRequest;

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
}
