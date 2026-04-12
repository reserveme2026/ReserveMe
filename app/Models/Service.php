<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'description',
        'duration_minutes',
        'price',
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
