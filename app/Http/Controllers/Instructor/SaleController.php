<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\CartCourse;
use App\Models\Instructor;


class SaleController extends Controller 
{
    public function index()
    {
        $nav = 'sales';
		$instructor_id = Auth::guard('instructor')->id();
        $courses_ids = array();
        $courses = Course::where('instructor_id', $instructor_id)->get();
        if($courses->count() > 0) {
            foreach($courses as $course) {
                array_push($courses_ids, $course->id);
            }
        }
        
		$data['user'] = Instructor::where('id', $instructor_id)->first();
        $data['sales'] = CartCourse::with('cart')->with('course')->with('course.category')->with('course.lessons')->with('course.instructor')->whereHas('cart', function ($q) use ($courses_ids) {
            $q->whereIn('course_id', $courses_ids); 
        })->get();
        $data['cnt'] = 1;
        return view('instructor.sale.index', compact('nav'), $data);
    }
}
