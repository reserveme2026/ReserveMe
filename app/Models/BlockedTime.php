<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockedTime extends Model
{
    protected $fillable = [
        'employee_id',
        'block_date',
        'start_time',
        'end_time',
        'reason',
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
