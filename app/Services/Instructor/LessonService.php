<?php
namespace App\Services\Instructor;

use App\Models\General;
use App\Models\Lesson;
use App\Models\Slug;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class LessonService
{
    use StoreImageTrait;
    function list($per_page, $page, $instructor_id, $course_id, $q) {
        $data['q'] = $q;
        $query = Lesson::select('*')->with('course')->where('course_id', '=', $course_id)
            ->whereHas('course', function ($q) use ($instructor_id) {
                $q->where('instructor_id', $instructor_id);
            });
        if ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
        }
        $data['lessons'] = $query->orderBy('id', 'asc')->paginate($per_page);
        $data['lessons']->appends(array('course_id' =>  Crypt::encryptString($course_id),'q' => $q));
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

    public function store($request)
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

    public function delete($request)
    {
        $id = $request->id;
        $ras = Lesson::findOrFail($id);
        Storage::disk('public')->delete('/uploads/lesson/' . $ras->file);
        Storage::disk('public')->delete('/uploads/lesson/' . $ras->video); 
        Storage::disk('public')->delete('/uploads/lesson/' . $ras->assessment);   
        Lesson::where('id', $id)->delete();
        Slug::where('slug', $ras->slug)->delete();
        return "success";
    }

    public function fileDelete($request)
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
