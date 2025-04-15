<?php

namespace App\Http\Integrations\Odds;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class OddsConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.the-odds-api.com/v4';
    }

    /**
     * The query parameters for the request
     */
    protected function defaultQuery(): array
    {
        return [
            'apiKey' => config('services.odds_api.key'),
            'regions' => 'us',
            'markets' => 'h2h,spreads,totals',
            'oddsFormat' => 'american',
            'bookmakers' => 'draftkings',
        ];
    }
}
