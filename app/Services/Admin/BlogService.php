<?php
namespace App\Services\Admin;

use App\Models\Blog;
use App\Models\General; 
use App\Models\Slug;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;

class BlogService
{
    use StoreImageTrait;
    function list($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Blog::select('*');
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

    public function status($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $blog = Blog::find($id);
        $blog->$field_name = $request->val;
        $blog->save();
    }

    public function store($request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $blog = Blog::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $blog = new Blog;
            $message = "Data added";
        }
        $slug_name = General::getSlug("blogs", "slug", $request['name'], $id);
        $slug = Slug::insertSlug("Blog", "BlogDetail", $slug_name, $request['slug']);

        if (isset($request['image'])) {
            $image = $this->StoreImage($request['image'], '/uploads/blog/');
        } else {
            $image = $request['old_image'];
        }
        $blog->date = $request['date'];
        $blog->name = $request['name'];
        $blog->short_description = $request['short_description'];
        $blog->description = $request['description'];
        $blog->image = $image;
        $blog->status = ($request['status']) ? 1 : 0;
        $blog->slug = $slug;
        $blog->meta_title = ($request['meta_title']) ? $request['meta_title'] : $request['name'];
        $blog->meta_description = $request['meta_description'];
        $blog->save();
        return $message;
    }

    public function delete($request)
    {
        $id = $request->id;
        $ras = Blog::findOrFail($id);
        Storage::disk('public')->delete('/uploads/blog/' . $ras->image);
        Blog::where('id', $id)->delete();
        Slug::where('slug', $ras->slug)->delete();
        return "success";
    }

    public function imageDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Blog::findOrFail($id);
        Storage::disk('public')->delete('/uploads/blog/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    }

}
