<?php

namespace App\Http\Controllers\Api;

use App\Enums\Sport;
use App\Http\Controllers\Controller;
use App\Http\Integrations\Odds\OddsConnector;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Throwable;

class OddsController extends Controller
{
    /**
     * Get all contents from The Odds API.
     */
    public function __invoke(Sport $sport)
    {
        try {
            return app(OddsConnector::class)
                ->send(new ($sport->request()))
                ->dto();
        } catch (FatalRequestException|RequestException $e) {
            abort(500, 'There was a problem with the request to the odds API.');
        } catch (Throwable $e) {
            abort(500, 'An unexpected error occurred.');
        }
    }
}
