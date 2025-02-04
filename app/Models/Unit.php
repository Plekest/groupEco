<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'fantasy_name',
        'company_name',
        'cnpj',
    ];

    public function flag()
    {
        return $this->belongsTo(Flag::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
