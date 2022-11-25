<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Instructor extends Authenticatable
{
    use HasFactory;
    protected $guard = 'instructor';
    
    protected $fillable = ['name', 'last_name', 'email', 'image', 'address', 'professional', 'company', 'state', 'zip', 'password', 'remember_token', 'status'];

    protected $hidden = [ 'password', 'remember_token', ];


    public function courses()
    {
        return $this->hasMany(Course::class, 'instructor_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(InstructorReview::class, 'instructor_id', 'id');
    }

    public static function avg_rating($instructor_id)
    {
       return round(InstructorReview::where('instructor_id',  $instructor_id)->avg('rating'));
    }
}
