<?php

namespace App\Http\Controllers;

use App\Models\Bet;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        $bets = Bet::query()
            ->where('user_id', Auth::id())
            ->whereBetween('created_at', [Carbon::now()->subWeeks(4), Carbon::now()])
            ->get();

        $wins = $bets->where('outcome', 'win')->count();
        $losses = $bets->where('outcome', 'lose')->count();
        $placed = $bets->whereNull('outcome')->count();

        return Inertia::render('Dashboard')
            ->with('bets', $bets)
            ->with('wins', $wins)
            ->with('losses', $losses)
            ->with('placed', $placed);
    }
}
