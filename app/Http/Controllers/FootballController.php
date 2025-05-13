<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class FootballController extends Controller
{
    public function index()
    {
        return Inertia::render('Football/Index');
    }
}
