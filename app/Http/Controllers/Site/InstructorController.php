<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use App\Models\Course;
use App\Services\Site\InstructorService;
use Illuminate\Http\Request;

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
        $per_page = 12;
        $title = 'Instructor';
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->instructor->List($per_page, $page, $q);
        return view('site.instructor.list', compact('nav', 'sub_nav', 'title'), $data);
        
    }

    public function InstructorDetail(Request $request)
    {
        $id = $request->segment(1); 
        $nav = '';
        $page = 'detail';
        $data['row'] = Instructor::with('courses')->with('reviews')->with('reviews.student')->where('slug', $id)->first();
        if ($data['row']) {
            return view('site.instructor.' . $page, compact('nav'), $data);
        } else {
            return redirect(route('/'));
        }
    }

}
