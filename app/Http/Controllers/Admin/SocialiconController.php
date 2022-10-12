<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialiconRequest;
use App\Models\Socialicon;
use App\Services\Admin\SocialiconService;
use Illuminate\Http\Request;

class SocialiconController extends Controller
{
    protected $socialicon;

    public function __construct(SocialiconService $SocialiconService)
    {
        $this->socialicon = $SocialiconService;
    }

    public function index(Request $request)
    {
        $nav = 'socialicon';
        $sub_nav = '';
        $data['row'] = Socialicon::first();
        $data['action'] = route('admin-socialicon-store');
        return view('admin.socialicon.index', compact('nav', 'sub_nav'), $data);
    }

    public function store(SocialiconRequest $request)
    {
        $message = $this->socialicon->store($request->validated());
        return redirect()->route('admin-socialicon')->withMessage($message);
    }
}
