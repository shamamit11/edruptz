<?php
namespace App\Services\Admin;
use App\Models\General;
use App\Models\Page;
use App\Models\Slug;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;
class PageService
{
    use StoreImageTrait;
    public function List($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Page::select('*')
        ->with('page_section');
        if ($q) {
            $query->where('name', 'LIKE', '%' . $q . '%');
            $query->orWhereHas('page_section', function ($qry) use ($q) {
                $qry->where('name', 'LIKE', '%' . $q . '%');
            });
        }
		$data['data'] = $query->orderBy('page_section_id', 'asc')->orderBy('orders', 'asc')->paginate($per_page);
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
        $this->page->status($request);
	}


    public function store($request)
    {
        if($request['id']) {
            $id = $request['id'];
            $page = Page::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $page = new Page;
            $message = "Data added";
        }
        if(isset($request['image'])) {
            $image =  $this->StoreImage($request['image'], '/uploads/page/');
        } else {
            $image = $request['old_image'];
        }
        $is_sitemap = (isset($request['is_sitemap']))  ? 1 : 0;
        $slug_name = General::getSlug("pages", "slug", $request['name'], $id);
        $slug = Slug::insertSlug("page", "pageDetail", $slug_name, $request['slug'], $is_sitemap);
        $page->name = $request['name'];
        $page->title = $request['title'];
        $page->sub_title = $request['sub_title'];
        $page->page_section_id = $request['page_section_id'];
        $page->short_description = $request['short_description'];
        $page->description = $request['description'];
        $page->image = $image;
        $page->video = General::youtube($request['video']);
        $page->slug = $slug;
        $page->orders = $request['orders'];
        $page->status = (isset($request['status'])) ? 1 : 0;
        $page->is_sitemap = $is_sitemap;
        $page->meta_title = ($request['meta_title']) ? $request['meta_title'] : $request['name'];
        $page->meta_description = $request['meta_description'];
        $page->save();
        return $message;
    }

    public function delete($request)
    {

        $id = $request->id;
        $ras = Page::findOrFail($id);
        Storage::disk('public')->delete('/uploads/page/' . $ras->image);
        Page::where('id', $id)->delete();
        Slug::where('slug', $ras->slug)->delete();
        return "success";
    }

    public function imageDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Page::findOrFail($id);
        Storage::disk('public')->delete('/uploads/page/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    } 
}
