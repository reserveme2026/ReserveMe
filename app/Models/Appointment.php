<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'appointment_date',
        'start_time',
        'status',
        'user_id',
        'bussiness_id',
        'employee_id',
        'service_id',
    ];
    public function bussiness()
    {
        return $this->belongsTo(Bussiness::class);
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
