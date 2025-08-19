<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $guarded = [];
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
      public function user()
    {
        return $this->belongsTo(User::class);
    }
   

    public function payments()
    {
        return $this->hasMany(Payment::class, 'patient_id');
    }

}
