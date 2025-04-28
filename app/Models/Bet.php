<?php

namespace App\Models;

use App\Enums\Outcome;
use App\Enums\SpreadBet;
use App\Enums\SpreadBetResult;
use Database\Factories\BetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Bet extends Model
{
    /** @use HasFactory<BetFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'winning_team_id',
        'outcome',
        'spread_bet_team_id',
        'spread_bet',
        'spread_bet_result',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deleted_at' => 'datetime',
        'spread_bet' => SpreadBet::class,
        'outcome' => Outcome::class,
        'spread_bet_result' => SpreadBetResult::class,
    ];

    /*
     * ----------------------------------------------------
     * Relationships
     * ----------------------------------------------------
     */
    public function wagerer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    protected static function booted(): void
    {
        static::creating(function (self $bet) {
            $bet->user_id ??= Auth::id();
        });
    }
}
