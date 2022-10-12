<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Category;
use App\Models\Instructor;
use App\Models\Lesson;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Requests\Instructor\LessonRequest;
use App\Services\Instructor\LessonService;
class LessonController extends Controller
{
    protected $lesson;

    public function __construct(LessonService $LessonService)
    {
        $this->lesson = $LessonService;
    }
	
    public function index(Request $request)
    {
        $nav = 'course';
	 	$instructor_id = Auth::guard('instructor')->id();
		$course_id = ($request->course_id) ? (int) Crypt::decryptString($request->course_id) : 0;
		$row_course = Course::where('id', $course_id)->where('instructor_id', $instructor_id)->first();
        if($row_course) {
			redirect(route('instructor-course'));
		} 
        $user = Instructor::where('id', $instructor_id)->first();
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->lesson->List($per_page, $page, $instructor_id, $course_id, $q);
        return view('instructor.lesson.index', compact('nav', 'user',  'row_course'), $data);
    }

    public function addEdit(Request $request)
    {
        $nav = 'lesson';
        $instructor_id = Auth::guard('instructor')->id();
        $user = Instructor::where('id', $instructor_id)->first();
		$course_id = ($request->course_id) ? (int) Crypt::decryptString($request->course_id) : 0;
        $id = ($request->id) ? (int) Crypt::decryptString($request->id) : 0;
        $data['title'] = ($id == 0) ? "Add Lesson" : "Edit Lesson";
        $data['action'] = route('instructor-lesson-addaction');
        $data['row'] = Lesson::where('id', $id)->where('course_id', $course_id)->first();
		$data['row_course'] = Course::where('id', $course_id)->where('instructor_id', $instructor_id)->first();
        $data['orders'] = Lesson::where('course_id', $course_id)->max('orders') + 1;
		if(!$data['row'] && !$data['row_course']) {
			redirect(route('instructor-course'));
		} 
        return view('instructor.lesson.add', compact('nav', 'user', 'course_id'), $data);
    }

    public function addAction(LessonRequest $request)
    {
        $message = $this->lesson->store($request->validated());
        return redirect()->route('instructor-lesson', ['course_id='. Crypt::encryptString($request->course_id)])->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->lesson->delete($request);
    }

    public function fileDelete(Request $request)
    {
        echo $this->lesson->fileDelete($request);
    }
}
