<?php

namespace App\Http\Integrations\Odds;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class OddsConnector extends Connector implements Cacheable
{
    use AcceptsJson;
    use HasCaching;

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
        $commenceTimeFrom = Carbon::now()->startOfWeek()->toIso8601ZuluString();

        $commenceTimeTo = Carbon::now()->addWeek()->endOfWeek()->toIso8601ZuluString();

        return [
            'apiKey' => config('services.odds_api.key'),
            'regions' => 'us',
            'markets' => 'h2h,spreads,totals',
            'oddsFormat' => 'american',
            'bookmakers' => 'draftkings',
            'commenceTimeFrom' => $commenceTimeFrom,
            'commenceTimeTo' => $commenceTimeTo,
        ];
    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(Cache::store('database'));
    }

    public function cacheExpiryInSeconds(): int
    {
        return 60 * 30; // 30 minutes
    }
}
