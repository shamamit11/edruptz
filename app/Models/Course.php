<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
    use HasFactory;
    protected $fillable = ['instructor_id', 'category_id', 'name', 'image', 'short_description', 'description', 'duration', 'amount', 'lectures', 'slug', 'status' ];

    protected $appends = ['avg_rating'];
	
	public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(CourseReview::class, 'course_id', 'id');
    }

    public function sales()
    {
        return $this->hasMany(CartCourse::class, 'course_id', 'id');  
    }

    public function skills()
    {
        return $this->hasMany(CourseSkill::class, 'course_id', 'id');  
    }

    public static function avg_rating($course_id)
    {
       return round(CourseReview::where('course_id',  $course_id)->avg('rating'));
    }
	
	

  
}
