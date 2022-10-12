<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Course;
use App\Models\CartCourse;
class DashboardController extends Controller
{
    public function index()
    {
        $nav = '';
		$student_id = Auth::guard('student')->id();
		$data['user'] = Student::where('id', $student_id)->first();
        $data['courses'] = CartCourse::with('cart')->with('course')->with('course.category')->with('course.lessons')->with('course.instructor')->whereHas('cart', function ($q) use ($student_id) {
            $q->where('student_id', $student_id); 
        })->get();
        return view('student.dashboard.index', compact('nav'), $data);
    }
}
