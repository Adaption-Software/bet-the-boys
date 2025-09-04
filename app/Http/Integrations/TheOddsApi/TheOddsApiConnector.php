<?php

namespace App\Http\Integrations\TheOddsApi;

use Saloon\Http\Connector;

class TheOddsApiConnector extends Connector
{
    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.the-odds-api.com/v4/sports/';
    }

    protected function defaultQuery(): array
    {
        return [
            'apiKey' => config('services.odds_api.key'),
        ];
    }
}
