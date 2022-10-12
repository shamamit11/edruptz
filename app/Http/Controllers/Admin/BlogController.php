<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;
use App\Models\General;
use App\Services\Admin\BlogService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    protected $blog;

    public function __construct(BlogService $BlogService)
    {
        $this->blog = $BlogService;
    }

    public function index(Request $request)
    {
        $nav = 'blog';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->blog->List($per_page, $page, $q);
        return view('admin.blog.list', compact('nav', 'sub_nav'), $data);
    }

    public function status(Request $request)
    {
        $this->blog->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'blog';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Blog" : "Edit Blog";
        $data['action'] = route('admin-blog-addaction');
        $data['row'] = Blog::where('id', $id)->first();
        return view('admin.blog.add', compact('nav', 'sub_nav'), $data);
    }

    public function addAction(BlogRequest $request)
    {
        $message = $this->blog->store($request->validated());
        return redirect()->route('admin-blog')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->blog->delete($request);
    }

    public function imageDelete(Request $request)
    {
        echo $this->blog->imageDelete($request);
    }
}
