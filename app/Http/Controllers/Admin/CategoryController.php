<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Models\General;
use App\Services\Admin\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryService $CategoryService)
    {
        $this->category = $CategoryService;
    }

    public function index(Request $request)
    {
        $nav = 'category';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->category->List($per_page, $page, $q);
        return view('admin.category.list', compact('nav', 'sub_nav'), $data);
    }

    public function status(Request $request)
    {
        $this->category->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'category';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Category" : "Edit Category";
        $data['action'] = route('admin-category-addaction');
        $data['row'] = Category::with('tags')->where('id', $id)->first();
        $data['tags'] = '';
        $tags = array();
        if($data['row'] && count($data['row']->tags) > 0){
            foreach($data['row']->tags as $tag) {
                array_push($tags, $tag->name);
            }
            $data['tags'] = implode(',', $tags);
        }
        return view('admin.category.add', compact('nav', 'sub_nav'), $data);
    }

    public function addAction(CategoryRequest $request)
    {
        $message = $this->category->store($request->validated());
        return redirect()->route('admin-category')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->category->delete($request);
    }
}
