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
        $bets = Auth::user()
            ->withWhereHas('bets', function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()]);
            })
            ->withCount([
                'bets as placed_count' => function ($query) {
                    $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()]);
                },
                'bets as pushed_count' => function ($query) {
                    $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])
                        ->where('outcome', Outcome::Draw);
                },
                'bets as won_count' => function ($query) {
                    $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])
                        ->where('outcome', Outcome::Win);
                },
                'bets as lost_count' => function ($query) {
                    $query->whereBetween('created_at', [Carbon::now()->subMonth(), Carbon::now()])
                        ->where('outcome', Outcome::Lose);
                }
            ])
            ->get()
            ->map(function ($user) {
                return [
                    ...$user->bets->map(function ($bet) use ($user) {
                        return [
                            'user' => $user->name,
                            'user_id' => $bet->user_id,
                            'bet_placed_at' => $bet->created_at->format('m/d/Y g:ia'),
                            'outcome' => $bet->outcome->label(),
                            'sport' => $bet->sport->label(),
                            'bet_type' => $bet->bet_type->label(),
                            'placed_count' => $user->placed_count,
                            'pushed_count' => $user->pushed_count,
                            'won_count' => $user->won_count,
                            'lost_count' => $user->lost_count,
                        ];
                    })
                ];
            })
            ->flatten(1);

        return Inertia::render('Dashboard')
            ->with('bets', $bets);
    }
}
