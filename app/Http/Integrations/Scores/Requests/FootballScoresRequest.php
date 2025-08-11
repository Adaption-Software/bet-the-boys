<?php

namespace App\Http\Integrations\Scores\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class FootballScoresRequest extends BaseScoresRequest
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
        return '/americanfootball_nfl/scores';
    }
}
