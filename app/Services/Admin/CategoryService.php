<?php
namespace App\Services\Admin;

use App\Models\Category;
use App\Models\CategoryTag;
use App\Models\General;
use App\Models\Slug;

class CategoryService
{
    function list($per_page, $page, $q) {
        $data['q'] = $q;
        $query = Category::select('*')->with('tags');
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
        $category = Category::find($id);
        $category->$field_name = $request->val;
        $category->save();
    }

    public function store($request)
    {
        if ($request['id']) {
            $id = $request['id'];
            $category = Category::find($id);
            $message = "Data updated";
        } else {
            $id = 0;
            $category = new Category;
            $message = "Data added";
        }
        $slug_name = General::getSlug("categories", "slug", $request['name'], $id);
        $slug = Slug::insertSlug("Category", "CategoryDetail", $slug_name, $request['slug']);
        $category->name = $request['name'];
        $category->status = ($request['status']) ? 1 : 0;
        $category->slug = $slug;
        $category->save();
        CategoryTag::where('category_id', $category->id)->delete();
        $tags = explode(',', $request['tags']);
        if (count($tags) > 0) {
            foreach ($tags as $tag) {
                $category_tag = new CategoryTag;
                $category_tag->category_id = $category->id;
                $category_tag->name = $tag;
                $category_tag->save();
            }
        }
        return $message;
    }

    public function delete($request)
    {
        $id = $request->id;
        $ras = Category::findOrFail($id);
        Category::where('id', $id)->delete();
        Slug::where('slug', $ras->slug)->delete();
        return "success";
    }

}
