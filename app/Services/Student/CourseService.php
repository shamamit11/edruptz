<?php
namespace App\Services\Student;


use App\Models\Course;
use App\Models\General;
use App\Models\Slug;
use App\Models\InstructorReview;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class CourseService
{
    public function reviews($request)
    {
        $review = new InstructorReview;
        $review->instructor_id = $request['instructor_id'];
        $review->student_id = Auth::guard('student')->id();
        $review->rating = $request['rating'];
        $review->description = $request['description'];
        $review->save();
        $message = "Thanks for your review.";
        return $message;
    }

}
