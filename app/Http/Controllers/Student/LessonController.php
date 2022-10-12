<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseReview;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\Student\AssessmentRequest;
use App\Http\Requests\Student\ReviewsCourseRequest;
use App\Services\Student\LessonService;

class LessonController extends Controller
{
    protected $lesson;

    public function __construct(LessonService $LessonService)
    {
        $this->lesson = $LessonService;
    }

    public function index($course_slug, $id)
    {

        $nav = 'course';
        $student_id = Auth::guard('student')->id();
        $data['user'] = Student::where('id', $student_id)->first();
        $id = ($id) ? (int) Crypt::decryptString($id) : 0;
        $data['row'] = $lesson = Lesson::with('course')->where('id', $id)->whereHas('course', function ($q) use ($course_slug) {
            $q->where('slug', $course_slug);
        })->first();
        if (!$data['row']) {
            redirect(route('student-course'));
        }
        $lesson->status = 1;
        $lesson->save();
		$data['assessment'] = Assessment::where('student_id', $student_id)->where('lesson_id', $id)->first();
        $data['avg_rating'] = round(CourseReview::where('course_id',  $data['row']->course_id)->avg('rating')) ;
        return view('student.lesson.detail', compact('nav'), $data);
        
    }

    public function download($id)
    {
        $nav = 'course';
        $student_id = Auth::guard('student')->id();
		$data['user'] = Student::where('id', $student_id)->first();
        $id =  (int) Crypt::decryptString($id);
        $row = Lesson::where('id', $id)->first();
		if(!$row) {
			redirect(route('student-course'));
		}
    }

    public function reviews(ReviewsCourseRequest $request)
    {
        $message = $this->lesson->reviews($request->validated());
        return redirect()->back()->withMessage($message);
    }

    public function assessment(AssessmentRequest $request)
    {
        $message = $this->lesson->assessment($request->validated());
        return redirect()->back()->withMessage($message);
    }
}
