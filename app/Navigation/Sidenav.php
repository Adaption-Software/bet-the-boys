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
            //                        Nav::make('NFL')
            //                            ->icon('football'),
            //            Nav::make('MLB')
            //                ->icon('baseball'),
            Nav::make('NBA')
                ->route('basketball.index')
                ->icon('basketball'),
//            Nav::make('Your Bets')
//                ->route('usersBets.index')
//                ->icon('admin'),

            //            Nav::make('NHL')
            //                ->icon('hockey-puck'),
        ];
    }
}
