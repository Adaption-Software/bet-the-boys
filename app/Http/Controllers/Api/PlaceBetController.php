<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bet;
use Illuminate\Http\Request;

class PlaceBetController extends Controller
{
    public function __invoke(Request $request)
    {
        Bet::create([
            'event_id' => $request->get('event_id'),
            'team_id' => $request->get('selected_team_id'),
        ]);
    }
}
