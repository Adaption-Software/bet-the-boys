<?php

namespace App\Models;

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
        'outcome' => 'enum',
        'cancelled' => 'boolean',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Bet::class, 'event_id');
    }
}
