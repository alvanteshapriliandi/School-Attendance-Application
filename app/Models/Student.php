<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'province',
        'gender',
        'guardian_name',
        'phone'
    ];
}
