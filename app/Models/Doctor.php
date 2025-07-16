<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id',
        'department_id',
        'available_days',
        'fee',
        'status',
        'image',
        'qualification',
        'slug',
        'start_time',
        'end_time',
        'slot_duration_minutes',
        'patients_per_slot',
        'unavailable_from',
        'unavailable_to',
        'max_booking_days'

    ];

    protected $casts = [
        'qualification' => 'array',
        'available_days' => 'array', // Fixed spelling here too
        'unavailable_from' => 'date',
        'unavailable_to' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
