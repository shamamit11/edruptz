<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\CartCourse;
use App\Models\Course;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $nav = '';
        $instructor_id = Auth::guard('instructor')->id();
        $data['user'] = Instructor::where('id', $instructor_id)->first();
        $data['courses'] = Course::with('lessons')->where('instructor_id', $instructor_id)->get();
        $data['sales'] = CartCourse::with('course')->whereHas('course', function ($q) use ($instructor_id) {
            $q->where('instructor_id', $instructor_id);
        })->get();
        $data['avg_rating'] = Instructor::avg_rating($instructor_id);
        return view('instructor.dashboard.index', compact('nav'), $data);
    }
}
