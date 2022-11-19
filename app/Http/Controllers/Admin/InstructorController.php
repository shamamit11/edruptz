<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\General;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Skill;
use App\Http\Requests\Admin\InstructorRequest;
use App\Services\Admin\InstructorService;
use Illuminate\Http\Request;
use App\Http\Requests\Instructor\CourseRequest;
use App\Http\Requests\Instructor\LessonRequest;
use Illuminate\Support\Facades\Storage;

use App\Exports\InstructorsExport;
use Maatwebsite\Excel\Facades\Excel;

class InstructorController extends Controller
{
    protected $instructor;

    public function __construct(InstructorService $InstructorService)
    {
        $this->instructor = $InstructorService;
    }

    public function index(Request $request)
    {
        $nav = 'instructor';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->instructor->List($per_page, $page, $q);
        return view('admin.instructor.list', compact('nav', 'sub_nav'), $data);
    }

    public function export() 
    {
        $export = new InstructorsExport();
        $file_name = 'instructors-'.time().'.xlsx';
        return Excel::download($export, $file_name);
    }

    public function detail(Request $request)
    {
        $nav = 'instructor';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = "Instructor Detail";
        $data['row'] = Instructor::where('id', $id)->first();
        return view('admin.instructor.detail', compact('nav', 'sub_nav'), $data);
    }

    public function addEdit(Request $request)
    {
        $nav = 'instructor';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Instructor" : "Edit Instructor";
        $data['action'] = route('admin-instructor-addaction');
        $data['row'] = Instructor::where('id', $id)->first();
        return view('admin.instructor.add', compact('nav', 'sub_nav'), $data);
    }

    public function addAction(InstructorRequest $request)
    {
        $message = $this->instructor->store($request->validated());
        return redirect()->route('admin-instructor')->withMessage($message);
    }

    public function courses(Request $request)
    {
        $nav = 'instructor';
        $sub_nav = '';
        $per_page = 10;
        $instructor_id = ($request->instructor_id) ? $request->instructor_id : 0;
        $instructor = Instructor::where('id', $instructor_id)->first();
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->instructor->courses($per_page, $page, $q, $instructor_id);
        return view('admin.instructor.courses', compact('nav', 'sub_nav', 'instructor'), $data);
    }

    public function courseEdit(Request $request)
    {
        $nav = 'instructor';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Course" : "Edit Course";
        $data['action'] = route('admin-instructor-course-editaction');
        $data['row'] = Course::with('skills')->where('id', $id)->first();
        $data['skills'] = Skill::orderBy('name', 'asc')->get();
        $data['categories'] = Category::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.instructor.editcourse', compact('nav', 'sub_nav'), $data);
    }

    public function courseEditAction(CourseRequest $request)
    {
        $message = $this->instructor->editCourse($request->validated());
        return redirect()->route('admin-instructor-courses', ['instructor_id='.$request->instructor_id])->withMessage($message);
    }

    public function courseImageDelete(Request $request)
    {
        echo $this->instructor->courseImageDelete($request);
    }

    public function lessons(Request $request)
    {
        $nav = 'instructor';
        $sub_nav = '';
        $per_page = 10;
        $course_id = ($request->course_id) ? $request->course_id : 0;
        $course = Course::where('id', $course_id)->first();
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->instructor->lessons($per_page, $page, $q, $course_id);
        return view('admin.instructor.lessons', compact('nav', 'sub_nav', 'course'), $data);
    }

    public function lessonEdit(Request $request) {
        $nav = 'instructor';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Lesson" : "Edit Lesson";
        $data['action'] = route('admin-instructor-course-lesson-editaction');
        $data['row'] = $lesson = Lesson::where('id', $id)->first();
        $data['orders'] = Lesson::where('course_id', $lesson->course_id)->max('orders') + 1;
        $course_id = $lesson->course_id;
        return view('admin.instructor.editlesson', compact('nav', 'sub_nav', 'course_id'), $data);
    }

    public function lessonEditAction(LessonRequest $request)
    {
        $message = $this->instructor->editLesson($request->validated());
        return redirect()->route('admin-instructor-courses-lessons', ['course_id='.$request->course_id])->withMessage($message);
    }

    public function lessonFileDelete(Request $request)
    {
        echo $this->instructor->lessonFileDelete($request);
    }
}
