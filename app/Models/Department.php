<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'status'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
