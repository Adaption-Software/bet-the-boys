<?php

namespace App\Navigation;

class Sidenav extends Navigation
{
    public function navigation(): array
    {
        return [
            Nav::make('Home'),
            Nav::make('NFL'),
            Nav::make('MLB'),
            Nav::make('NBA'),
            Nav::make('NHL'),
        ];
    }
}
