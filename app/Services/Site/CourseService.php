<?php
namespace App\Services\Site;

use App\Models\Course;
use App\Models\Search;

class CourseService
{

    function list($per_page, $page, $q, $age) {
        $data['q'] = $q;
        $data['age'] = $age;
        $query = Course::select('*')->with('category')->where('status', 1);
        if ($age) {
            $ages = explode(" - ", $age);
            $age_from = $ages[0];
            $age_to = $ages[1];
            $query->where('age_from', $age_from)->where('age_to', $age_to);
        }
        if ($q) {
            $this->searches($q);
            $query->where('name', 'LIKE', '%' . $q . '%');
            $query->orWhereHas('category', function ($qr) use ($q) {
                $qr->where('name', 'LIKE', '%' . $q . '%');
            });
        }
        $data['courses'] = $query->where('status', 1)->orderBy('id', 'desc')->paginate($per_page);
        $data['courses']->appends(array('q' => $q));
        $data['age_ranges'] = $this->Agerange();
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

    public function ListByCategory($per_page, $page, $slug, $q, $age)
    {
        $data['q'] = $q;
        $data['age'] = $age;
        $query = Course::select('*')->where('status', 1)->with('category')->whereHas('category', function ($qr) use ($slug) {
            $qr->where('name', $slug);
        });
        if ($age) {
            $ages = explode(" - ", $age);
            $age_from = $ages[0];
            $age_to = $ages[1];
            $query->where('age_from', $age_from)->where('age_to', $age_to);
        }
        if ($q) {
            $this->searches($q);
            $query->where('name', 'LIKE', '%' . $q . '%');
        }
        $data['courses'] = $query->orderBy('id', 'desc')->paginate($per_page);
        $data['courses']->appends(array('q' => $q));
        $data['age_ranges'] = $this->Agerange();
        if ($page != 1) {
            $data['count'] = ($per_page * $page) - $per_page + 1;
            $data['from_data'] = $data['count'];
            $to_data = $page * $data['courses']->count();
            $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['data']->total();
        } else {
            $data['count'] = 1;
            $data['from_data'] = 1;
            $data['to_data'] = $data['courses']->count();
        }
        return $data;
    }

    public function searches($q)
    {
        $search = Search::where('keywords', $q)->first();
        if ($search) {
            $search->times = $search->times + 1;
            $search->save();
        } else {
            $search = new Search;
            $search->keywords = $q;
            $search->times = 1;
            $search->save();
        }
    }

    public function Agerange()
    {
        $courses = Course::orderBy('age_from', 'asc')->get();
        $age_range = array();
        if ($courses->count() > 0) {
            foreach ($courses as $course) {
                array_push($age_range, $course->age_from . ' - ' . $course->age_to);
            }
        }
        if (count($age_range) > 0) {
            return array_unique($age_range);
        } else {
            return $age_range;
        }
    }

}
