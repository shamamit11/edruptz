<?php
namespace App\Services\Admin;

use App\Models\Banner;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    use StoreImageTrait;
    function list($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Banner::select('*');
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
        $banner = Banner::find($id);
        $banner->$field_name = $request->val;
        $banner->save();
	}

    public function store($request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $banner = Banner::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $banner = new Banner;
            $message = "Data added";
        }
        if (isset($request['image'])) {
            $image = $this->StoreImage($request['image'], '/uploads/banner/');
        } else {
            $image = $request['old_image'];  
        }
        $banner->name = $request['name'];
        $banner->sub_title = $request['sub_title'];
        $banner->description = $request['description'];
        $banner->website = $request['website'];
        $banner->orders = $request['orders'];
        $banner->status = (isset($request['status'])) ? 1 : 0;
        $banner->image = $image;
        $banner->save();
        return $message;
    }

    public function delete($request)
    {

        $id = $request->id;
        $ras = Banner::findOrFail($id);
        Storage::disk('public')->delete('/uploads/banner/' . $ras->image);
        Banner::where('id', $id)->delete();
        return "success";
    }

    public function imageDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Banner::findOrFail($id);
        Storage::disk('public')->delete('/uploads/banner/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    }
}
