<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        $bets = Bet::query()
            ->leftJoin('users', 'users.id', '=', 'bets.user_id')
            ->whereBetween('bets.created_at', [Carbon::now()->subMonth(), Carbon::now()])
            ->get()
            ->map(function (Bet $bet) {
                return [
                    'user' => $bet->name,
                    'user_id' => $bet->user_id,
                    'bet_placed_at' => $bet->created_at->format('m/d/Y g:ia'),
                    'outcome' => $bet->outcome->label(),
                    'sport' => $bet->sport->label(),
                    'bet_type' => $bet->bet_type->label(),
                ];
            })
            ->groupBy('user');

        $wins = $bets->sum(fn (Collection $bet) => $bet->where('outcome', 'Win')->count());

        $losses = $bets->sum(fn (Collection $bet) => $bet->where('outcome', 'Lose')->count());

        $placed = $bets->sum(fn (Collection $bet) => $bet->count());

        return Inertia::render('Dashboard')
            ->with('bets', $bets)
            ->with('wins', $wins)
            ->with('losses', $losses)
            ->with('placed', $placed);
    }
}
