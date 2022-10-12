<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use App\Models\Setting;
use App\Services\Admin\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $setting;

    public function __construct(SettingService $SettingService)
    {
        $this->setting = $SettingService;
    }

    public function index(Request $request)
    {
        $nav = 'setting';
        $sub_nav = '';
        $data['row'] = Setting::first();
        $data['action'] = route('admin-setting-store');
        return view('admin.setting.index', compact('nav', 'sub_nav'), $data);
    }

    public function store(SettingRequest $request)
    {
        $message = $this->setting->store($request->validated());
        return redirect()->route('admin-setting')->withMessage($message);
    }
}
