<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceBetRequest;
use App\Models\Bet;

class PlaceBetController extends Controller
{
    public function __invoke(PlaceBetRequest $request)
    {
        $bet = Bet::create($request->validated());

        return response()->json($bet);
    }
}
