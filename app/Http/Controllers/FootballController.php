<?php

namespace App\Http\Controllers;

use App\Enums\Sport;
use Carbon\WeekDay;
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
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(WeekDay::Thursday),
                Carbon::now()->endOfWeek(WeekDay::Tuesday),
            ])
            ->get();

        return Inertia::render('Football/Index')
            ->with('placedBets', $placedBets);
    }
}
