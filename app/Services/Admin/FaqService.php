<?php
namespace App\Services\Admin;

use App\Models\Faq;
use App\Models\General;
use App\Models\Slug;

class FaqService
{
    function list($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Faq::select('*');
        if ($q) {
            $query->where('question', 'LIKE', '%' . $q . '%');
        }
        $data['data'] = $query->orderBy('types', 'asc')->orderBy('orders', 'asc')->paginate($per_page);
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

    public function status($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $faq = Faq::find($id);
        $faq->$field_name = $request->val;
        $faq->save();
    }

    public function store($request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $faq = Faq::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $faq = new Faq;
            $message = "Data added";
        }
        $faq->question = $request['question'];
        $faq->answer = $request['answer'];
        $faq->orders = $request['orders'];
        $faq->types = $request['types'];
        $faq->status = ($request['status']) ? 1 : 0;
        $faq->save();
        return $message;
    }

    public function delete($request)
    {
        $id = $request->id;
        Faq::where('id', $id)->delete();
        return "success";
    }

}
