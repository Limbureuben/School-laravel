<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRegistration extends Model
{

    protected $fillable = [
        'first_name',
        'last_name',
        'reg_no',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
