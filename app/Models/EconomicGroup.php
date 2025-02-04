<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicGroup extends Model
{
    protected $fillable = [
        'name',
    ];

    public function flags()
    {
        return $this->hasMany(Flag::class);
    }
}
