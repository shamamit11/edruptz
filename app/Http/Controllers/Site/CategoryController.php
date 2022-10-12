<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Services\Site\CourseService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $course;

    public function __construct(CourseService $CourseService)
    {
        $this->course = $CourseService;
    }

    public function CategoryDetail(Request $request)
    {
        $slug = $request->segment(1);
        $row = Category::where('slug', $slug)->where('status', '1')->first();
        if ($row) {
            $nav = 'course';
            $title = $row->name;
            $sub_nav = '';
            $per_page = 12;
            $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
            $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
			$age = ($request->has('age') && !empty($request->age)) ? $request->age : '';
            $data = $this->course->ListByCategory($per_page, $page, $slug, $q, $age);
            return view('site.course.list', compact('nav', 'sub_nav', 'row', 'title'), $data);
        } else {
            return redirect(route('/'));
        }

    }

}
