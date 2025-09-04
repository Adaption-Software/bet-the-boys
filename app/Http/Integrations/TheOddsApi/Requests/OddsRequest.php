<?php

namespace App\Http\Integrations\TheOddsApi\Requests;

use App\Enums\BetType;
use App\Enums\Sport;
use App\Models\Team;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class OddsRequest extends Request implements Cacheable
{
    use HasCaching;

    protected Method $method = Method::GET;

    protected Collection $teams;

    public function __construct(protected Sport $sport)
    {
        $this->teams = Team::query()->where('sport', $sport)->pluck('id', 'team_name');
    }

    /**
     * {@inheritDoc}
     */
    public function resolveEndpoint(): string
    {
        return $this->sport->endpoint().'/odds';
    }

    protected function defaultQuery(): array
    {
        $commenceTimeFrom = Carbon::now()->startOfWeek()->toIso8601ZuluString();

        $commenceTimeTo = Carbon::now()->addWeek()->endOfWeek()->toIso8601ZuluString();

        return [
            'regions' => 'us',
            'markets' => 'h2h,spreads,totals',
            'oddsFormat' => 'american',
            'bookmakers' => 'draftkings',
            'commenceTimeFrom' => $commenceTimeFrom,
            'commenceTimeTo' => $commenceTimeTo
        ];
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->collect()
            ->map(function ($event) {
                $event = collect($event);

                $home = $event->get('home_team');
                $away = $event->get('away_team');

                $markets = collect(data_get($event, 'bookmakers.{first}.markets'))
                    ->pluck('outcomes', 'key');

                $moneylines = collect($markets->get('h2h'))->pluck('price', 'name');

                [$over, $under] = collect($markets->get('totals'))
                    ->partition(fn ($item) => Str::lower($item['name']) === BetType::Over->value);

                return [
                    'id' => $event->get('id'),
                    'commence_time' => $event->get('commence_time'),
                    'sport_title' => $event->get('sport_title'),
                    'home_team' => $this->team($home, $moneylines, $under, BetType::Under),
                    'away_team' => $this->team($away, $moneylines, $over, BetType::Over),
                ];
            });
    }

    protected function team($team, $moneylines, $totals, $type): array
    {
        [$current, $opposition] = $moneylines->partition(fn ($item, $key) => $key === $team);

        $cast = $current->first() > $opposition->first() ? BetType::Favorite : BetType::Dawg;

        $total = $totals->first();

        return [
            'name' => $team,
            'id' => $this->teams->get($team),
            'moneyline' => [
                'price' => $moneylines->get($team),
                'type' => $cast,
            ],
            'total' => [
                'type' => $type->value,
                'price' => $total['price'] ?? 0,
                'point' => $total['point'] ?? 0,
            ],
        ];
    }

    protected function cacheKey(): ?string
    {
        return Str::kebab($this->sport->endpoint());
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
