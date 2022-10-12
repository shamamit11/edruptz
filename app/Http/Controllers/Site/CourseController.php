<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\Site\CourseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    protected $service;

    public function __construct(CourseService $CourseService)
    {
        $this->course = $CourseService;
    }

    public function index(Request $request)
    {
        $nav = 'course';
        $sub_nav = '';
        $per_page = 12;
        $title = 'Courses';
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $age = ($request->has('age') && !empty($request->age)) ? $request->age : '';
        $data = $this->course->List($per_page, $page, $q, $age);
        return view('site.course.list', compact('nav', 'sub_nav', 'title'), $data);

    }

    public function CourseDetail(Request $request)
    {
        $slug = $request->segment(1);
        $nav = 'course';
        $data['count'] = 1;
        $data['row'] = Course::with('lessons')->with('reviews')->with('reviews.student')->with('reviews.reply')->with('instructor')->with('instructor.courses')->with('sales')->with('category')->where('slug', $slug)->first();

        $data['isStudentLogin'] = (Auth::guard('student')->guest()) ? false : true;
        if ($data['row']) {
            $share_buttons = \Share::page(route($data['row']->slug), $data['row']->name)->facebook()->twitter()->linkedin()->whatsapp()->telegram();
            $data['share_buttons'] = $share_buttons;
            $data['related_courses'] = Course::where('category_id', $data['row']->category_id)->where([['id', '<>', $data['row']->id], ['status', '=', 1]])->inRandomOrder()->limit(9)->get();
            return view('site.course.detail', compact('nav'), $data);
        } else {
            return redirect(route('/'));
        }

    }

}
