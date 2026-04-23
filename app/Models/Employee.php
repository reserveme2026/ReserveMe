<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'business_id'
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }

    public function blockedTimes() {
        return $this->hasMany(BlockedTime::class);
    }
}
