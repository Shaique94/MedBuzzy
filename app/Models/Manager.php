<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Manager extends Model
{
      use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_id',
        'address',
        'photo',
        'gender',
        'dob',
        'status',
    ];

    /**
     * Get the user details for this manager.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the doctor who created this manager.
     */
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}
