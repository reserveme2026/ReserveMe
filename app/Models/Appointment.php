<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'user_id',
        'business_id',
        'employee_id',
        'service_id',
        'appointment_date',
        'start_time',
        'end_time',
        'status',
        'service_name',
        'service_duration_minutes',
        'service_price',
        'notes',
    ];
    public function business()
    {
        return $this->belongsTo(Business::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
