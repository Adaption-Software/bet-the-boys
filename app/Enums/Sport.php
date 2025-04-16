<?php

namespace App\Enums;

use App\Http\Integrations\Odds\Requests\BasketballRequest;

enum Sport: string
{
    case Basketball = 'basketball';

    public function request(): string
    {
        return match ($this) {
            self::Basketball => BasketballRequest::class,
        };
    }
}
