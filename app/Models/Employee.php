<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'bussiness_id'
    ];

    public function bussiness()
    {
        return $this->belongsTo(Bussiness::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
