<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'owner_plan'
    ];

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
    public function businesses()
    {
        return $this->hasMany(Business::class, 'owner_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function ownerRequests()
    {
        return $this->hasMany(OwnerRequest::class);
    }

    public function getPlanLimit()
    {
        if ($this->owner_plan == 'starter') {
            return 1;
        }

        if ($this->owner_plan == 'pro') {
            return 3;
        }

        if ($this->owner_plan == 'premium') {
            return 6;
        }

        return null;
    }

    public function canCreateBusiness()
    {
        if ($this->role != 'owner') {
            return false;
        }
        
        if ($this->getPlanLimit() === null) {
            return false;
        }

        return $this->businesses()->count() < $this->getPlanLimit();
    }
}
