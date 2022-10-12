<?php
namespace App\Services\Student;

use App\Models\General;
use App\Models\Assessment;
use App\Models\Lesson;
use App\Models\Course;
use App\Models\CourseReview;
use App\Models\Slug;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LessonService
{
    use StoreImageTrait;
    public function reviews($request)
    {
        $review = new CourseReview;
        $review->course_id = $request['course_id'];
        $review->student_id = Auth::guard('student')->id();
        $review->rating = $request['rating'];
        $review->description = $request['description'];
        $review->save();
        $message = "Thanks for your review.";
        return $message;
    }

    public function assessment($request)
    {
        if (isset($request['assessment'])) {
            $assessment_file = $this->StoreImage($request['assessment'], '/uploads/assessment/');
        } else {
            $assessment_file = null;
        }
        $assessment = new Assessment;
        $assessment->lesson_id = $request['lesson_id'];
        $assessment->student_id = Auth::guard('student')->id();
        $assessment->instructor_id = $request['instructor_id'];
        $assessment->assessment = $assessment_file;
        $assessment->save();
        $message = "Assessment is submitted.";
        return $message;
    }

    
}
