<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function alumniProfile(): HasOne
    {
        return $this->hasOne(AlumniProfile::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'creator_id');
    }

    public function campaigns(): HasMany
    {
        return $this->hasMany(Campaign::class, 'creator_id');
    }

    public function jobPosts(): HasMany
    {
        return $this->hasMany(JobPost::class, 'poster_id');
    }

    public function attendedEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'rsvps')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class, 'donor_id');
    }

    public function isAlumni(): bool
    {
        return $this->hasRole('alumni');
    }

    public function isStudent(): bool
    {
        return $this->hasRole('student');
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }
}
