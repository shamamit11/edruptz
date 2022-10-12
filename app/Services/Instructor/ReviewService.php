<?php
namespace App\Services\Instructor;

use App\Models\Course;
use App\Models\CourseReview;
use App\Models\ReviewReply;
use Illuminate\Support\Facades\Auth;

 
class ReviewService
{
    function list($per_page, $page, $instructor_id, $q) {
        $data['q'] = $q;
        $query = CourseReview::select('*')->with('course')->with('reply')->with('course.instructor')->whereHas('course', function ($qr) use ($instructor_id) {
            $qr->where('instructor_id', $instructor_id);
        });
        // if ($q) {
        //     $query->where('name', 'LIKE', '%' . $q . '%');
        // }
        $data['reviews'] = $query->orderBy('id', 'desc')->paginate($per_page);
        $data['reviews']->appends(array('q' => $q));
        if ($page != 1) {
            $data['count'] = ($per_page * $page) - $per_page + 1;
            $data['from_data'] = $data['count'];
            $to_data = $page * $data['reviews']->count();
            $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['reviews']->total();
        } else {
            $data['count'] = 1;
            $data['from_data'] = 1;
            $data['to_data'] = $data['reviews']->count();
        }
        return $data;
    }


    public function store($request)
    {
        $instructor_id = Auth::guard('instructor')->id();
        $course_review_id = $request['id'];
        ReviewReply::where('course_review_id', $course_review_id)->where('instructor_id', $instructor_id)->delete();   
        $review = new ReviewReply;
        $review->course_review_id = $course_review_id;
        $review->instructor_id = $instructor_id;
        $review->description = $request['description'];
        $review->save();
        $message = "Data added";
        return $message;
    }

    public function delete($request)
    {
        $id = $request->id;
        $ras = ReviewReply::findOrFail($id);
        ReviewReply::where('id', $id)->delete();
        return "success";
    }
}
