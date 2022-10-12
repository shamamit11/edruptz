<?php
namespace App\Services\Admin;

use App\Models\Course;
use App\Models\CourseSkill;
use App\Models\General;
use App\Models\Instructor;
use App\Models\Lesson;
use App\Models\Slug;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;

class InstructorService
{
    use StoreImageTrait;

    function list($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Instructor::select('*')->with('courses');
        if ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
        }
        $data['data'] = $query->orderBy('id', 'desc')->paginate($per_page);
        $data['data']->appends(array('q' => $q));
        if ($page != 1) {
            $data['count'] = ($per_page * $page) - $per_page + 1;
            $data['from_data'] = $data['count'];
            $to_data = $page * $data['data']->count();
            $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['data']->total();
        } else {
            $data['count'] = 1;
            $data['from_data'] = 1;
            $data['to_data'] = $data['data']->count();
        }
        return $data;
    }

    public function store($request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $instructor = Instructor::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $instructor = new Instructor;
            $message = "Data added";
        }
        $instructor->commission = $request['commission'];
        $instructor->status = $request['status'];
        $instructor->admin_set = 1;
        $instructor->save();
        return $message;
    }

    public function courses($per_page, $page, $q, $instructor_id)
    {
        $data['q'] = $q;
        $query = Course::select('*')->with('category')->with('lessons')->with('sales')->where('instructor_id', $instructor_id);
        if ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
            $query->orWhereHas('category', function ($qr) use ($q) {
                $qr->where('name', 'LIKE', '%' . $q . '%');
            });
        }
        $data['courses'] = $query->orderBy('id', 'desc')->paginate($per_page);
        $data['courses']->appends(array('id' => $instructor_id, 'q' => $q));
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

    public function editCourse($request)
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
        $slug_name = General::getSlug("courses", "slug", $request['name'], $id);
        $slug = Slug::insertSlug("Course", "CourseDetail", $slug_name, $request['slug']);

        if (isset($request['image'])) {
            $image = $this->StoreImage($request['image'], '/uploads/course/');
        } else {
            $image = $request['old_image'];
        }

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
        $course->status = $request['status'];
        $course->meta_title = $request['name'];
        $course->save();

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

        return $message;
    }

    public function courseImageDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Course::findOrFail($id);
        Storage::disk('public')->delete('/uploads/course/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    }

    public function lessons($per_page, $page, $q, $course_id)
    {
        $data['q'] = $q;
        $query = Lesson::select('*')->with('course')->where('course_id', '=', $course_id);
        if ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
        }
        $data['lessons'] = $query->orderBy('id', 'desc')->paginate($per_page);
        $data['lessons']->appends(array('course_id' => $course_id, 'q' => $q));
        if ($page != 1) {
            $data['count'] = ($per_page * $page) - $per_page + 1;
            $data['from_data'] = $data['count'];
            $to_data = $page * $data['lessons']->count();
            $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['lessons']->total();
        } else {
            $data['count'] = 1;
            $data['from_data'] = 1;
            $data['to_data'] = $data['lessons']->count();
        }
        return $data;
    }

    public function editLesson($request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $lesson = Lesson::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $lesson = new Lesson;
            $message = "Data added";
        }

        if (isset($request['file'])) {
            $file = $this->StoreImage($request['file'], '/uploads/lesson/');
        } else {
            $file = $request['old_file'];
        }

        if (isset($request['video'])) {
            $video = $this->StoreImage($request['video'], '/uploads/lesson/');
        } else {
            $video = $request['old_video'];
        }

        if (isset($request['assessment'])) {
            $assessment = $this->StoreImage($request['assessment'], '/uploads/lesson/');
        } else {
            $assessment = $request['old_assessment'];
        }

        $lesson->course_id = $request['course_id'];
        $lesson->name = $request['name'];
        $lesson->file = $file;
        $lesson->video = $video;
        $lesson->assessment = $assessment;
        $lesson->summary = $request['summary'];
        $lesson->description = $request['description'];
        $lesson->orders = $request['lesson_number'];
        $lesson->save();
        return $message;
    }

    public function lessonFileDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Lesson::findOrFail($id);
        Storage::disk('public')->delete('/uploads/lesson/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    }
}
