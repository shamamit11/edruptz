<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;
    protected $guard = 'student';
    
    protected $fillable = ['name', 'email', 'image', 'address', 'amout_me', 'company', 'state', 'zip', 'password', 'remember_token', 'status'];

    protected $hidden = [ 'password', 'remember_token', ];
}
