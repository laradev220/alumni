<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'location_type',
        'location_details',
        'zoom_link',
        'creator_id',
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function attendees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'rsvps')
            ->withPivot('status')
            ->withTimestamps();
    }
}
