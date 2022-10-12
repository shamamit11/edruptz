<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use App\Models\General;
use App\Services\Admin\FaqService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FaqController extends Controller
{
    protected $faq;

    public function __construct(FaqService $FaqService)
    {
        $this->faq = $FaqService;
    }

    public function index(Request $request)
    {
        $nav = 'faq';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->faq->List($per_page, $page, $q);
        return view('admin.faq.list', compact('nav', 'sub_nav'), $data);
    }

    public function status(Request $request)
    {
        $this->faq->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'faq';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Faq" : "Edit Faq";
        $data['action'] = route('admin-faq-addaction');
        $data['row'] = Faq::where('id', $id)->first();
        $data['orders'] = General::getMax('faqs', 'orders');
        return view('admin.faq.add', compact('nav', 'sub_nav'), $data);
    }

    public function addAction(FaqRequest $request)
    {
        $message = $this->faq->store($request->validated());
        return redirect()->route('admin-faq')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->faq->delete($request);
    }
}
