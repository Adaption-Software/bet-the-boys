<?php

namespace App\Http\Controllers;

use App\Enums\Outcome;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        $dateRange = [Carbon::now()->subMonth(), Carbon::now()];

        $bets = Auth::user()
            ->with(['bets' => function ($query) use ($dateRange) {
                $query->whereBetween('created_at', $dateRange)->with('team');
            }])
            ->withCount([
                'bets as placed_count' => fn ($query) => $query->whereBetween('created_at', $dateRange),
                'bets as pushed_count' => fn ($query) => $query->whereBetween('created_at', $dateRange)->where('outcome', Outcome::Draw),
                'bets as won_count' => fn ($query) => $query->whereBetween('created_at', $dateRange)->where('outcome', Outcome::Win),
                'bets as lost_count' => fn ($query) => $query->whereBetween('created_at', $dateRange)->where('outcome', Outcome::Lose),
            ])
            ->whereHas('bets', function ($query) use ($dateRange) {
                $query->whereBetween('created_at', $dateRange);
            })
            ->get()
            ->map(function ($user) {
                return $user->bets->map(function ($bet) use ($user) {
                    return [
                        'user' => $user->name,
                        'user_id' => $bet->user_id,
                        'team_name' => $bet->team->team_name,
                        'bet_placed_at' => $bet->created_at->format('m/d/Y g:ia'),
                        'outcome' => $bet->outcome?->label() ?? 'No Outcome Yet',
                        'sport' => $bet->sport->label(),
                        'bet_type' => $bet->bet_type->label(),
                        'placed_count' => $user->placed_count,
                        'pushed_count' => $user->pushed_count,
                        'won_count' => $user->won_count,
                        'lost_count' => $user->lost_count,
                    ];
                });
            })
            ->flatten(1);

        return Inertia::render('Dashboard')
            ->with('bets', $bets);
    }
}
