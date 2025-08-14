<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name','slug','status'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($department) {
        $department->slug = \Illuminate\Support\Str::slug($department->name);
    });

    static::updating(function ($department) {
        $department->slug = \Illuminate\Support\Str::slug($department->name);
    });
}
}
