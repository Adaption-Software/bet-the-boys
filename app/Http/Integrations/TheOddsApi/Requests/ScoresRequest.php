<?php

namespace App\Http\Integrations\TheOddsApi\Requests;

use App\Enums\Sport;
use App\Models\Team;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Plugins\AcceptsJson;

class ScoresRequest extends Request
{
    use AcceptsJson;

    protected Method $method = Method::GET;

    protected Collection $teams;

    public function __construct(protected Sport $sport, protected Collection $eventIds)
    {
        $this->teams = Team::query()->where('sport', $sport)->pluck('id', 'team_name');
    }

    public function resolveEndpoint(): string
    {
        return $this->sport->endpoint().'/scores';
    }

    protected function defaultQuery(): array
    {
        return [
            'daysFrom' => 3,
            'eventIds' => $this->eventIds->join(','),
        ];
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->collect()
            ->filter(fn ($event) => $event['completed'])
            ->mapWithKeys(function ($event) {
                $scores = collect($event['scores'])
                    ->pluck('score', 'name')
                    ->mapWithKeys(function ($score, $name) {
                        $teamId = $this->teams->get($name);

                        return [$teamId => $score];
                    });

                return [$event['id'] => $scores];
            });
    }
}
