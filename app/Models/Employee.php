<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'cpf',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
