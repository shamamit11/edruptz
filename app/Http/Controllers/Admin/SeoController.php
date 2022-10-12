<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeoRequest;
use App\Models\Seo;
use App\Services\Admin\SeoService;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    protected $seo;

    public function __construct(SeoService $SeoService)
    {
        $this->seo = $SeoService;
    }

    public function index(Request $request)
    {
        $nav = 'seo';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->seo->List($per_page, $page, $q);
        return view('admin.seo.list', compact('nav', 'sub_nav'), $data);
    }

    public function addEdit(Request $request)
    {
        $nav = 'seo';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add SEO" : "Edit SEO";
        $data['action'] = route('admin-seo-addaction');
        $data['row'] = Seo::where('id', $id)->first();
        return view('admin.seo.add', compact('nav', 'sub_nav'), $data);
    }

    public function addAction(SeoRequest $request)
    {
        $message = $this->seo->store($request->validated());
        return redirect()->route('admin-seo')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->seo->delete($request);
    }
}
