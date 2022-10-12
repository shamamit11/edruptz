<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Page;
use App\Models\Review;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $nav = '';
        $data['student_faqs'] = Faq::where('types', 'student')->where('status', '1')->orderBy('orders', 'asc')->get();
        $data['instructor_faqs'] = Faq::where('types', 'instructor')->where('status', '1')->orderBy('orders', 'asc')->get();
        $data['cnt']  = 1;
        $data['count']  = 1;
        return view('site.faq.index', compact('nav'), $data);
    }
}
