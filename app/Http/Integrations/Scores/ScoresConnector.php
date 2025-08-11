<?php

namespace App\Http\Integrations\Scores;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class ScoresConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.the-odds-api.com/v4/sports';
    }

    /**
     * The query parameters for the request
     */
    protected function defaultQuery(): array
    {
        return [
            'apiKey' => config('services.odds_api.key'),
            'daysFrom' => 3,
        ];
    }
}
