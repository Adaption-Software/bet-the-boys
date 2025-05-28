<?php

namespace App\Navigation;

class Sidenav extends Navigation
{
    public function navigation(): array
    {
        return [
            Nav::make('Home')
                ->route('dashboard')
                ->icon('house'),

            Nav::make('NFL')
                ->route('football.index')
                ->icon('football'),

            Nav::make('NBA')
                ->route('basketball.index')
                ->icon('basketball'),
        ];
    }
}
