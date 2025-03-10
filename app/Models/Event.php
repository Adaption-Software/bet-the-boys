<?php

namespace App\Models;

use App\Enums\Outcome;
use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'winning_team_id',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'outcome' => Outcome::class,
        'cancelled' => 'boolean',
    ];

    public function bets(): HasMany
    {
        return $this->hasMany(Bet::class, 'event_id');
    }
}
