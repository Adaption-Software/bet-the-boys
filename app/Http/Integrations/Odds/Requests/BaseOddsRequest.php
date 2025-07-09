<?php

namespace App\Http\Integrations\Odds\Requests;

use App\Enums\BetType;
use App\Enums\Sport;
use App\Models\Team;
use Illuminate\Support\Collection;
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
            ->keyBy('id')
            ->map(function ($game) {
                $markets = collect(data_get($game, 'bookmakers.{first}.markets'));

                $odds = $markets->mapWithKeys(function ($market) {
                    $outcomes = collect($market['outcomes'])->mapWithKeys(function ($outcome) {
                        return [$outcome['name'] => collect($outcome)->except('name')->toArray()];
                    });

                    return [$market['key'] => $outcomes];
                })->toArray();

                return [
                    'start_time' => $game['commence_time'],
                    'sport_key' => $game['sport_key'],
                    'sport_title' => $game['sport_title'],
                    'away_team' => $this->team('away_team', $game, $odds),
                    'home_team' => $this->team('home_team', $game, $odds),
                ];
            });
    }

    protected function team(string $location, array $game, array $odds): array
    {
        $name = data_get($game, $location);

        $isHomeTeam = $location === 'home_team';

        if ($isHomeTeam) {
            $total = data_get($odds, 'totals.Under');
            data_set($total, 'type', BetType::Under);
        } else {
            $total = data_get($odds, 'totals.Over');
            data_set($total, 'type', BetType::Over);
        }

        $moneyline = data_get($odds, "h2h.{$name}");

        if (data_get($moneyline, 'price', 0) > 0) {
            data_set($moneyline, 'type', BetType::Favorite);
        } else {
            data_set($moneyline, 'type', BetType::Dawg);
        }

        return [
            'name' => $name,
            'id' => $this->teams->get($name),
            'moneyline' => $moneyline,
            'total' => $total,
        ];
    }
}
