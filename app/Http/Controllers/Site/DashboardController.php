<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Page;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $nav = '';
        $data['banners'] = Banner::where('status', '1')->orderBy('orders', 'asc')->get();
        $data['ras_welcome'] = Page::where('id', '1')->first();
        $data['why'] = Page::where('id', '2')->first();
        $data['reviews'] = Review::where('status', '1')->inRandomOrder()->limit(5)->get();
        $data['courses'] = Course::where('status', '1')->with('instructor')->with('category')->with('sales')->with('reviews')->limit(9)->get();
        // dd( $data['courses']);
        $data['instructors'] = Instructor::with('courses')->with('courses.category')->with('courses.sales')->where('status', 1)->limit(6)->get();
        //  dd(  $data['instructors'] );
        return view('site.dashboard.index', compact('nav'), $data);
    }
}
