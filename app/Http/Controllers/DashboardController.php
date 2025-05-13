<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        $bets = Bet::query()
            ->where('user_id', Auth::id())
            ->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])
            ->get()
            ->map(function (Bet $bet) {
                return [
                    'bet_placed_at' => $bet->created_at->format('m/d/Y g:ia'),
                    'outcome' => $bet->outcome->label(),
                    'spread_bet' => $bet->spread_bet->label(),
                    'active_bets' => $bet->spread_bet_result->value,
                ];
            });

        $wins = $bets->where('outcome', 'Win')->count();
        $losses = $bets->where('outcome', 'Lose')->count();
        $placed = $bets->whereNull('active_bets')->count();

        return Inertia::render('Dashboard')
            ->with('bets', $bets)
            ->with('wins', $wins)
            ->with('losses', $losses)
            ->with('placed', $placed);
    }
}
