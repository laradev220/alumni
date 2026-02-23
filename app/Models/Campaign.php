<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'goal_amount',
        'current_amount',
        'status',
        'creator_id',
        'end_date',
    ];

    protected $casts = [
        'goal_amount' => 'decimal:2',
        'current_amount' => 'decimal:2',
        'end_date' => 'date',
        'status' => 'string',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function getProgressPercentageAttribute(): int
    {
        if ($this->goal_amount == 0) {
            return 0;
        }

        return min(100, (int) (($this->current_amount / $this->goal_amount) * 100));
    }
}
