<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bussiness extends Model
{
    protected $fillable = [
        'name',
        'description',
        'phone',
        'address',
        'email',
        'owner_id'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
