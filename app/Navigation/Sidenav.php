<?php

namespace App\Navigation;

class Sidenav extends Navigation
{
    public function navigation(): array
    {
        return [
            Nav::make('Home')
//                ->route('dashboard')
                ->icon('house'),
            Nav::make('NFL')
                ->icon('football'),
            Nav::make('MLB')
                ->icon('baseball'),
            Nav::make('NBA')
                ->icon('basketball'),
            Nav::make('NHL')
                ->icon('hockey-puck'),
        ];
    }
}
