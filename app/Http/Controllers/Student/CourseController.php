<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Course;
use App\Models\CartCourse;
use App\Models\Cart;
use App\Models\Category; 
use App\Models\InstructorReview;
use App\Models\Lesson;  
use Illuminate\Http\Request;

use App\Http\Requests\Student\ReviewsInstructorRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Storage;
use App\Services\Student\CourseService;
use Response;

class CourseController extends Controller
{
    protected $course;

    public function __construct(CourseService $CourseService)
    {
        $this->course = $CourseService;
    }
	
    public function index(Request $request)
    { 
        $nav = 'course';
        $student_id = Auth::guard('student')->id();
		$data['user'] = Student::where('id', $student_id)->first();
        $data['courses'] = CartCourse::with('cart')->with('course')->with('course.category')->with('course.lessons')->with('course.instructor')->whereHas('cart', function ($q) use ($student_id) {
            $q->where('student_id', $student_id); 
        })->get();
		$data['count'] = 1;
        return view('student.course.index', compact('nav'), $data);
    }

    public function detail($id)
    {
        $nav = 'course';
        $student_id = Auth::guard('student')->id();
		$data['user'] = Student::where('id', $student_id)->first();
        $id =  (int) Crypt::decryptString($id);
        $data['row'] = Course::with('lessons')->with('instructor')->with('instructor.reviews')->where('id', $id)->first();
		if(!$data['row']) {
			redirect(route('student-course'));
		}
        $data['avg_rating'] = round(InstructorReview::where('instructor_id',  $data['row']->instructor_id)->avg('rating')) ; 
        return view('student.course.detail', compact('nav'), $data);
    }

    public function reviews(ReviewsInstructorRequest $request)
    {
        $message = $this->course->reviews($request->validated());
        return redirect()->back()->withMessage($message);
    }

   

    // public function addAction(CourseRequest $request)
    // {
    //     $message = $this->course->store($request->validated());
    //     return redirect()->route('instructor-course')->withMessage($message);
    // }

    // public function delete(Request $request)
    // {
    //     echo $this->course->delete($request);
    // }

    // public function imageDelete(Request $request)
    // {
    //     echo $this->course->imageDelete($request);
    // }
}
