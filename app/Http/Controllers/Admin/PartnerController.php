<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Models\Partner;
use App\Models\General;
use App\Services\Admin\PartnerService;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    protected $partner;

    public function __construct(PartnerService $PartnerService)
    {
        $this->partner = $PartnerService;
    }

    public function index(Request $request)
    {
        $nav = 'partner';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->partner->List($per_page, $page, $q);
        return view('admin.partner.list', compact('nav', 'sub_nav'), $data);
    }

    public function status(Request $request)
    {
        $this->partner->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'partner';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Partner" : "Edit Partner";
        $data['action'] = route('admin-partner-addaction');
        $data['row'] = Partner::where('id', $id)->first();
        $data['orders'] = General::getMax('partners', 'orders');
        return view('admin.partner.add', compact('nav', 'sub_nav'), $data);
    }

    public function addAction(PartnerRequest $request)
    {
        $message = $this->partner->store($request->validated());
        return redirect()->route('admin-partner')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->partner->delete($request);
    }

    public function imageDelete(Request $request)
    {
        echo $this->partner->imageDelete($request);
    }
}
