<?php
namespace App\Services\Instructor;

use App\Models\Course;
use App\Models\CourseSkill;
use App\Models\General;
use App\Models\Slug;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseService
{
    use StoreImageTrait;
    function list($per_page, $page, $instructor_id, $q) {
        $data['q'] = $q;
        $query = Course::select('*')->with('category')->with('lessons')->with('sales')->where('instructor_id', $instructor_id);
        if ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
            $query->orWhereHas('category', function ($qr) use ($q) {
                $qr->where('name', 'LIKE', '%' . $q . '%');
            });
        }
        $data['courses'] = $query->orderBy('id', 'desc')->paginate($per_page);
        $data['courses']->appends(array('q' => $q));
        if ($page != 1) {
            $data['count'] = ($per_page * $page) - $per_page + 1;
            $data['from_data'] = $data['count'];
            $to_data = $page * $data['courses']->count();
            $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['courses']->total();
        } else {
            $data['count'] = 1;
            $data['from_data'] = 1;
            $data['to_data'] = $data['courses']->count();
        }
        return $data;
    }

    public function store($request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $course = Course::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $course = new Course;
            $message = "Data added";
        }
        $instructor_id = Auth::guard('instructor')->id();
        $slug_name = General::getSlug("courses", "slug", $request['name'], $id);
        $slug = Slug::insertSlug("Course", "CourseDetail", $slug_name, $request['slug']);

        if (isset($request['image'])) {
            $image = $this->StoreImage($request['image'], '/uploads/course/');
        } else {
            $image = $request['old_image'];
        }
        $course->instructor_id = $instructor_id;
        $course->category_id = $request['category_id'];
        $course->name = $request['name'];
        $course->image = $image;
        $course->summary = $request['summary'];
        $course->description = $request['description'];
        $course->duration = $request['duration'];
        $course->amount = $request['amount'];
        $course->lectures = $request['lectures'];
        $course->age_from = $request['age_from'];
        $course->age_to = $request['age_to'];
        $course->slug = $slug;
        $course->status = $request['status'] ? $request['status'] : 0;
        $course->meta_title = $request['name'];
        $course->save();

        if ($request['skill_id_1'] == null || !$request['skill_id_2'] == null || !$request['skill_id_3'] == null) {
            CourseSkill::where('course_id', $course->id)->delete();
        }

        if ($request['skill_id_1'] || $request['skill_id_2'] || $request['skill_id_3']) {
            CourseSkill::where('course_id', $course->id)->delete();
            $course_skill = new CourseSkill;
            $course_skill->course_id = $course->id;
            $course_skill->skill_id = $request['skill_id_1'];
            $course_skill->percent = $request['percent_1'];
            $course_skill->save();

            $course_skill = new CourseSkill;
            $course_skill->course_id = $course->id;
            $course_skill->skill_id = $request['skill_id_2'];
            $course_skill->percent = $request['percent_2'];
            $course_skill->save();

            $course_skill = new CourseSkill;
            $course_skill->course_id = $course->id;
            $course_skill->skill_id = $request['skill_id_3'];
            $course_skill->percent = $request['percent_3'];
            $course_skill->save();
        }

        return $message;
    }

    public function delete($request)
    {
        $id = $request->id;
        $ras = Course::findOrFail($id);
        Storage::disk('public')->delete('/uploads/course/' . $ras->image);
        Course::where('id', $id)->delete();
        Slug::where('slug', $ras->slug)->delete();
        return "success";
    }

    public function imageDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Course::findOrFail($id);
        Storage::disk('public')->delete('/uploads/course/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    }

}
