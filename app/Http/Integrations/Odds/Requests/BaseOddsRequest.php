<?php

namespace App\Http\Integrations\Odds\Requests;

use App\Enums\BetType;
use App\Enums\Sport;
use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Saloon\Http\Request;
use Saloon\Http\Response;

abstract class BaseOddsRequest extends Request
{
    protected Collection $teams;

    public function __construct(protected Sport $sport)
    {
        $this->teams = Team::query()->where('sport', $sport)->pluck('id', 'team_name');
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
                    ->partition(fn($item) => Str::lower($item['name']) === BetType::Over->value);

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
        [$current, $opposition] =  $moneylines->partition(fn($item, $key) => $key === $team);

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
}
