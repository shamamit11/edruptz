<?php
namespace App\Services\Instructor;

use App\Models\Course;
use App\Models\CourseReview;
use App\Models\Assessment;
use Illuminate\Support\Facades\Auth;

 
class AssessmentService
{
    function list($per_page, $page, $instructor_id, $q) {
        $data['q'] = $q;
        $query = Assessment::select('*')->with('lesson')->with('student')->where('instructor_id', $instructor_id);
        $data['assessments'] = $query->orderBy('id', 'desc')->paginate($per_page);
        if ($page != 1) {
            $data['count'] = ($per_page * $page) - $per_page + 1;
            $data['from_data'] = $data['count'];
            $to_data = $page * $data['assessments']->count();
            $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['assessments']->total();
        } else {
            $data['count'] = 1;
            $data['from_data'] = 1;
            $data['to_data'] = $data['assessments']->count();
        }
        return $data;
    }

    public function status($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $faq = Assessment::find($id);
        $faq->$field_name = $request->val;
        $faq->save();
    }

  
}
