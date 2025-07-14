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
    ];

    protected $casts = [
        'qualification' => 'array',
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
