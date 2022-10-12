<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;  
use App\Models\Assessment;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\CourseReview;
use App\Models\ReviewReply;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Requests\Instructor\ReviewRequest;
use App\Services\Instructor\AssessmentService;

class AssessmentController extends Controller
{
    protected $assessment;

    public function __construct(AssessmentService $AssessmentService)
    {
        $this->assessment = $AssessmentService;
    }
	
    public function index(Request $request)
    {
        $nav = 'assessment';
	 	$instructor_id = Auth::guard('instructor')->id();
        $user = Instructor::where('id', $instructor_id)->first();
        $per_page = 20;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->assessment->List($per_page, $page, $instructor_id, $q);
        return view('instructor.assessment.index', compact('nav', 'user'), $data);
    }

    public function status(Request $request)
    {
        $this->assessment->status($request);
    }

    
}
