<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'description',
        'location',
        'salary_range',
        'poster_id',
    ];

    protected $casts = [
        'salary_range' => 'string',
    ];

    public function poster(): BelongsTo
    {
        return $this->belongsTo(User::class, 'poster_id');
    }
}
