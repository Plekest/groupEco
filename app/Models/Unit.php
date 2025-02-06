<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'fantasy_name',
        'company_name',
        'cnpj',
        'flag_id',
    ];

    public function flag()
    {
        return $this->belongsTo(Flag::class, 'flag_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
