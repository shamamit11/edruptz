<?php
namespace App\Services\Admin;
use App\Models\Seo;
class SeoService
{
    public function List($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Seo::select('*');
        if($q) {
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
        if($request['id']) {
            $id = $request['id'];
            $seo = Seo::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $seo = new Seo;
            $message = "Data added";
        }
        $seo->name = $request['name'];
        $seo->link = $request['link'];
        $seo->meta_title = $request['meta_title'];
        $seo->meta_description = $request['meta_description'];
        $seo->save();
        return $message;
    }

    public function delete($request)
    {
        $id = $request->id;
        Seo::where('id', $id)->delete();
        return "success";
    }
}
