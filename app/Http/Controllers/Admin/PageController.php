<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\General;
use App\Models\Page;
use App\Models\PageSection;
use App\Services\Admin\PageService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    protected $page;

    public function __construct(PageService $PageService)
    {
        $this->page = $PageService;
    }

    public function index(Request $request)
    {
        $nav = 'page';
        $sub_nav = '';
        $per_page = 30;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->page->List($per_page, $page, $q);
        return view('admin.page.list', compact('nav', 'sub_nav'), $data);
    }

    public function status(Request $request)
    {
        $this->page->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'page';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Page" : "Edit Page";
        $data['action'] = route('admin-page-addaction');
        $data['page_sections'] = PageSection::get();
        $data['row'] = Page::where('id', $id)->first();
        $data['orders'] = General::getMax('pages', 'orders');
        return view('admin.page.add', compact('nav', 'sub_nav'), $data);
    }

    public function addAction(PageRequest $request)
    {
        $message = $this->page->store($request->validated());
        return redirect()->route('admin-page')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->page->delete($request);
    }

    public function imageDelete(Request $request)
    {
        echo $this->page->imageDelete($request);
    }
}
