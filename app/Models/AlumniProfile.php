<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'graduation_year',
        'department',
        'city',
        'current_job',
        'linkedin_url',
        'bio',
        'profile_photo_url',
        'privacy_settings',
        'verified',
        'verification_document_url',
    ];

    protected $casts = [
        'privacy_settings' => 'array',
        'verified' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
