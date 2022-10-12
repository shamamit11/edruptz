<?php
namespace App\Services\Admin;

use App\Models\Review;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;

class ReviewService
{
    use StoreImageTrait;
    function list($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Review::select('*');
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

    public function status(Request $request) {
        $this->review->status($request);
	}

    public function store($request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $review = Review::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $review = new Review;
            $message = "Data added";
        }
        if (isset($request['image'])) {
            $image = $this->StoreImage($request['image'], '/uploads/review/');
        } else {
            $image = $request['old_image'];
        }
        $review->name = $request['name'];
        $review->description = $request['description'];
        $review->image = $image;
        $review->designation = $request['designation'];
        $review->status = (isset($request['status'])) ? 1 : 0;
        $review->save();
        return $message;
    }

    public function delete($request)
    {

        $id = $request->id;
        $ras = Review::findOrFail($id);
        Storage::disk('public')->delete('/uploads/review/' . $ras->image);
        Review::where('id', $id)->delete();
        return "success";
    }

    public function imageDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Review::findOrFail($id);
        Storage::disk('public')->delete('/uploads/review/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    } 
}
