<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Requests\Instructor\CourseRequest;
use App\Services\Instructor\CourseService;
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
	 	$instructor_id = Auth::guard('instructor')->id();
        $user = Instructor::where('id', $instructor_id)->first();
        $per_page = 20;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->course->List($per_page, $page, $instructor_id, $q);
        return view('instructor.course.index', compact('nav', 'user'), $data);
    }

    public function addEdit(Request $request)
    {
        $nav = 'course';
        $instructor_id = Auth::guard('instructor')->id();
        $user = Instructor::where('id', $instructor_id)->first();
        $id = ($request->id) ? (int) Crypt::decryptString($request->id) : 0;
        $data['title'] = ($id == 0) ? "Add Course" : "Edit Course";
        $data['action'] = route('instructor-course-addaction');
        $data['row'] = Course::with('skills')->where('id', $id)->where('instructor_id', $instructor_id)->first();
		if(!$data['row']) {
			redirect(route('instructor-course'));
		}
        $data['skills'] = Skill::orderBy('name', 'asc')->get();
        $data['categories'] = Category::where('status', 1)->orderBy('name', 'asc')->get();
        return view('instructor.course.add', compact('nav', 'user'), $data);
    }

    public function addAction(CourseRequest $request)
    {
        $message = $this->course->store($request->validated());
        return redirect()->route('instructor-course')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->course->delete($request);
    }

    public function imageDelete(Request $request)
    {
        echo $this->course->imageDelete($request);
    }
}
