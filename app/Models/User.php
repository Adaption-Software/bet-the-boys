<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable implements FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    /*
    * ----------------------------------------------------
    * Methods
    * ----------------------------------------------------
    */

    public function canAccessPanel(Panel $panel): bool
    {
        return (bool) Auth::user()->is_admin;
    }

    /*
     * ----------------------------------------------------
     * Relationships
     * ----------------------------------------------------
     */
    /**
     * Groups this user belongs to.
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(
            Group::class,
            'group_users',
            'user_id',
            'group_id'
        );
    }

    public function bets(): HasMany
    {
        return $this->hasMany(Bet::class);
    }
}
