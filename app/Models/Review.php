<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
     protected $guarded = [];
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
