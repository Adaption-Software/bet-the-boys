<?php

namespace App\Http\Controllers;

use App\Enums\Sport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class FootballController extends Controller
{
    public function index()
    {
        $placedBets = Auth::user()
            ->bets()
            ->where('sport', Sport::Football)
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();

        return Inertia::render('Football/Index')
            ->with('placedBets', $placedBets);
    }
}
