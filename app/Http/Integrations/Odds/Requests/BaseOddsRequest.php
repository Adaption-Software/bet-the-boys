<?php

namespace App\Http\Integrations\Odds\Requests;

use Saloon\Http\Request;
use Saloon\Http\Response;

abstract class BaseOddsRequest extends Request
{
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
                    'away_team' => [
                        'name' => $game['away_team'],
                        'spread' => data_get($odds, "spreads.{$game['away_team']}"),
                        'h2h' => data_get($odds, "h2h.{$game['away_team']}"),
                    ],
                    'home_team' => [
                        'name' => $game['home_team'],
                        'spread' => data_get($odds, "spreads.{$game['home_team']}"),
                        'h2h' => data_get($odds, "h2h.{$game['home_team']}"),
                    ],
                    'over_under' => data_get($odds, 'totals'),
                ];
            });
    }
}
