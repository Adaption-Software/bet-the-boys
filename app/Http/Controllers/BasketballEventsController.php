<?php

namespace App\Http\Controllers;

use App\Enums\Sport;
use Carbon\WeekDay;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class BasketballEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $placedBets = Auth::user()
            ->bets()
            ->where('sport', Sport::Basketball)
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(WeekDay::Thursday),
                Carbon::now()->endOfWeek(WeekDay::Tuesday),
            ])
            ->get();

        return Inertia::render('Basketball/Index')
            ->with('placedBets', $placedBets);
    }
}
