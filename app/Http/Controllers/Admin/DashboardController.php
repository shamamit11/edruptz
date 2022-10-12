<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $nav = '';
        $sub_nav = '';
        return view('admin.dashboard.index', compact('nav', 'sub_nav'));
    }
}
