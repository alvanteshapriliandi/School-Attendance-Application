<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'address',
        'city',
        'province',
        'study',
        'homeroom_teacher',
        'phone'
    ];
}
