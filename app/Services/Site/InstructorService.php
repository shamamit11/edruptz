<?php
namespace App\Services\Site;

use App\Models\Instructor;

class InstructorService
{

    function list($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Instructor::with('courses')->with('courses.category')->with('courses.sales');
        if ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
        }
        $data['instructors'] = $query->where('status', 1);
        $data['instructors'] = $query->orderBy('id', 'desc')->paginate($per_page);
        $data['instructors']->appends(array('q' => $q));
        if ($page != 1) {
            $data['count'] = ($per_page * $page) - $per_page + 1;
            $data['from_data'] = $data['count'];
            $to_data = $page * $data['instructors']->count();
            $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['data']->total();
        } else {
            $data['count'] = 1;
            $data['from_data'] = 1;
            $data['to_data'] = $data['instructors']->count();
        }
        return $data;
    }

}
