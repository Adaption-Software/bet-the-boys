<?php

namespace App\Models;

use Database\Factories\GroupFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Group extends Model
{
    /** @use HasFactory<GroupFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'leader_id',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var list<string>
     */
    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /*
     * ----------------------------------------------------
     * Relationships
     * ----------------------------------------------------
     */
    public function leader(): BelongsTo
    {
        return   $this->belongsTo(User::class, 'leader_id');
    }
}
