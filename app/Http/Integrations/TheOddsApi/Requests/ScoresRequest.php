<?php

namespace App\Http\Integrations\TheOddsApi\Requests;

use App\Enums\Sport;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Plugins\AcceptsJson;

class ScoresRequest extends Request
{
    use AcceptsJson;

    protected Method $method = Method::GET;

    public function __construct(protected Sport $sport) {}

    public function resolveEndpoint(): string
    {
        return $this->sport->endpoint().'/scores';
    }

    protected function defaultQuery(): array
    {
        return [
            'daysFrom' => 3,
        ];
    }
}
