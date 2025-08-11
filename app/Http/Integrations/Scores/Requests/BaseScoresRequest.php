<?php

namespace App\Http\Integrations\Scores\Requests;

use Saloon\Http\Request;
use Saloon\Http\Response;

abstract class BaseScoresRequest extends Request
{
    public function createDtoFromResponse(Response $response): mixed
    {
        dump($response);

        return $response->collect();
    }
}
