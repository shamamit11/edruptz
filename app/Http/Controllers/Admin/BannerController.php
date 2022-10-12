<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BannerRequest;
use App\Models\Banner;
use App\Models\General;
use App\Services\Admin\BannerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    protected $banner;

    public function __construct(BannerService $BannerService)
    {
        $this->banner = $BannerService;
    }

    public function index(Request $request)
    {
        $nav = 'banner';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->banner->List($per_page, $page, $q);
        return view('admin.banner.list', compact('nav', 'sub_nav'), $data);
    }

    public function status(Request $request)
    {
        $this->banner->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'banner';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Banner" : "Edit Banner";
        $data['action'] = route('admin-banner-addaction');
        $data['row'] = Banner::where('id', $id)->first();
        $data['orders'] = General::getMax('banners', 'orders');
        return view('admin.banner.add', compact('nav', 'sub_nav'), $data);
    }


    public function addAction(BannerRequest $request)
    {
        $message = $this->banner->store($request->validated());
        return redirect()->route('admin-banner')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->banner->delete($request);
    }

    public function imageDelete(Request $request)
    {
        echo $this->banner->imageDelete($request);
    }
}
