<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    protected $fillable = [
        'name',
    ];

    public function economicGroup()
    {
        return $this->belongsTo(EconomicGroup::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}
