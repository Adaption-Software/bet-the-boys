<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BasketballOddsController extends Controller
{
    protected string $baseUrl = 'https://api.the-odds-api.com/v4/';

    protected mixed $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.odds_api.key', env('ODDS_API_KEY'));
    }

    /**
     * Get all contents from The Odds API.
     */
    public function __invoke(): JsonResponse
    {
        $endpoint = $this->baseUrl.'sports/basketball_nba/odds';

        $params = [
            'apiKey' => $this->apiKey,
            'regions' => 'us',
            'markets' => 'h2h,spreads,totals',
            'oddsFormat' => 'american',
            'bookmakers' => 'draftkings',
        ];

        $response = Http::get($endpoint, $params);

        if ($response->successful()) {
            $data = $response->json();

            return response()->json($data);
        } else {
            Log::error('The Odds API request failed', [
                'status' => $response->status(),
                'response' => $response->body(),
            ]);

            return response()->json([
                'error' => 'Unable to retrieve data from The Odds API',
            ], $response->status());
        }
    }
}
