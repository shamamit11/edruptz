<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommissionRequest;
use App\Models\Commission;
use App\Models\General;
use App\Services\Admin\CommissionService;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    protected $commission;

    public function __construct(CommissionService $CommissionService)
    {
        $this->commission = $CommissionService;
    }

    public function index(Request $request)
    {
        $nav = 'commission';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->commission->List($per_page, $page, $q);
        return view('admin.commission.list', compact('nav', 'sub_nav'), $data);
    }

    public function status(Request $request)
    {
        $this->commission->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'commission';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Commission" : "Edit Commission";
        $data['action'] = route('admin-commission-addaction');
        $data['row'] = Commission::where('id', $id)->first();
        return view('admin.commission.add', compact('nav', 'sub_nav'), $data);
    }


    public function addAction(CommissionRequest $request)
    {
        $message = $this->commission->store($request->validated());
        return redirect()->route('admin-commission')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->commission->delete($request);
    }
}
