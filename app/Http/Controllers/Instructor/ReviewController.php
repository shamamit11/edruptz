<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Instructor;
use App\Models\Course;
use App\Models\CourseReview;
use App\Models\ReviewReply;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;
use App\Http\Requests\Instructor\ReviewRequest;
use App\Services\Instructor\ReviewService;

class ReviewController extends Controller
{
    protected $review;

    public function __construct(ReviewService $ReviewService)
    {
        $this->review = $ReviewService;
    }
	
    public function index(Request $request)
    {
        $nav = 'review';
	 	$instructor_id = Auth::guard('instructor')->id();
        $user = Instructor::where('id', $instructor_id)->first();
        $per_page = 20;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->review->List($per_page, $page, $instructor_id, $q);
        return view('instructor.review.index', compact('nav', 'user'), $data);
    }

    public function addEdit(Request $request)
    {
        $nav = 'review';
        $instructor_id = Auth::guard('instructor')->id();
        $user = Instructor::where('id', $instructor_id)->first();
        $id = ($request->id) ? (int) Crypt::decryptString($request->id) : 0;
        $data['title'] = ($id == 0) ? "Add Review" : "Edit Review";
        $data['action'] = route('instructor-review-addaction');
        $data['row'] =  CourseReview::select('*')->with('course')->with('reply')->with('course.instructor')->where('id', $id)->whereHas('course', function ($qr) use ($instructor_id) {
            $qr->where('instructor_id', $instructor_id);
        })->first();
		if(!$data['row']) {
			redirect(route('instructor-review'));
		}
        return view('instructor.review.add', compact('nav', 'user'), $data);
    }

    public function addAction(ReviewRequest $request)
    {
        $message = $this->review->store($request->validated());
        return redirect()->route('instructor-review')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->review->delete($request);
    }
}
