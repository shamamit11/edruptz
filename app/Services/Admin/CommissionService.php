<?php
namespace App\Services\Admin;

use App\Models\Commission;

class CommissionService
{
    function list($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Commission::select('*');
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

    public function status($request) {
        $id = $request->id;
        $field_name = $request->field_name;
        $commission = Commission::find($id);
        $commission->$field_name = $request->val;
        $commission->save();
	}

    public function store($request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $commission = Commission::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $commission = new Commission;
            $message = "Data added";
        }
        $commission->name = $request['name'];
        $commission->commission = $request['commission'];
        $commission->status = (isset($request['status'])) ? 1 : 0;
        $commission->default = (isset($request['default'])) ? 1 : 0;
        $commission->save();
        return $message;
    }

    public function delete($request)
    {

        $id = $request->id;
        Commission::where('id', $id)->delete();
        return "success";
    }

}
