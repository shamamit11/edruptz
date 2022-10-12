<?php
namespace App\Services\Admin;
use App\Models\Partner;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;
class PartnerService
{
    use StoreImageTrait;
    public function List($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Partner::select('*');
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

    public function status(Request $request) {
        $this->partner->status($request);
	}


    public function store($request)
    {
        if($request['id']) {
            $id = $request['id'];
            $partner = Partner::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $partner = new Partner;
            $message = "Data added";
        }
        if(isset($request['image'])) {
            $image =  $this->StoreImage($request['image'], '/uploads/partner/');
        } else {
            $image = $request['old_image'];
        }
        $partner->name = $request['name'];
        $partner->website = $request['website'];
        $partner->orders = $request['orders'];
        $partner->status = (isset($request['status'])) ? 1 : 0;
        $partner->image = $image;
        $partner->save();
        return $message;
    }

    public function delete($request)
    {

        $id = $request->id;
        $ras = Partner::findOrFail($id);
        Storage::disk('public')->delete('/uploads/partner/' . $ras->image);
        Partner::where('id', $id)->delete();
        return "success";
    }

    public function imageDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Partner::findOrFail($id);
        Storage::disk('public')->delete('/uploads/partner/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    } 
}
