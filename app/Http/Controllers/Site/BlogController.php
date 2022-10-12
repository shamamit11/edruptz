<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Services\Site\BlogService;

class BlogController extends Controller
{
    protected $service;

    public function __construct(BlogService $BlogService)
    {
        $this->blog = $BlogService;
    }

    public function index(Request $request)
    {
        $nav = 'blog';
        $sub_nav = '';
        $per_page = 1;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $data = $this->blog->List($per_page, $page);
		$data['latest_blogs'] = Blog::where('status', '1')->orderBy('date', 'DESC')->limit(10)->get();
        return view('site.blog.list', compact('nav', 'sub_nav'), $data);
        
    }

    public function BlogDetail(Request $request)
    {
        $slug = $request->segment(1);
        $nav = 'blog';
        $data['count'] = 1;
        $data['cnt'] = 1;
        $data['row'] = Blog::where('slug', $slug)->where('status', '1')->first();
        if ($data['row']) {
			$data['latest_blogs'] = Blog::where('status', '1')->orderBy('date', 'DESC')->limit(10)->get();
            return view('site.blog.detail', compact('nav'), $data);
        } else {
            return redirect(route('/'));
        }

    }

   
}
