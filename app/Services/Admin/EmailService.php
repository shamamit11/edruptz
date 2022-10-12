<?php
namespace App\Services\Admin;

use App\Models\Email;

class EmailService
{
    function list($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Email::select('*');
        if ($q) {
            $query->where('email', 'LIKE', '%' . $q . '%');
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

    public function delete($request)
    {

        $id = $request->id;
        Email::where('id', $id)->delete();
        return "success";
    }
}
