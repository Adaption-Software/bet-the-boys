<?php

namespace App\Http\Integrations\Odds\Requests;

use Saloon\Enums\Method;

class FootballRequest extends BaseOddsRequest
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
        return '/americanfootball_nfl/odds';
    }
}
