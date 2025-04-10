<?php

namespace App\Http\Integrations\Odds\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class BasketballRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/sports/basketball_nba/odds';
    }
}
