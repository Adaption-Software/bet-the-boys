<?php

namespace App\Models;

use App\Enums\BetType;
use App\Enums\Outcome;
use App\Enums\Sport;
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
        'team_id',
        'outcome',
        'bet_type',
        'sport_type',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'deleted_at' => 'datetime',
        'outcome' => Outcome::class,
        'bet_type' => BetType::class,
        'sport' => Sport::class,
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

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected static function booted(): void
    {
        static::creating(function (self $bet) {
            $bet->user_id ??= Auth::id();
        });
    }
}
