<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function pageDetail(Request $request)
    {
        $id = $request->segment(1);
        $nav = 'about-edruptz';
        $page = 'index';
        $data['row'] = Page::where('slug', $id)->first();
        if ($data['row'] && $data['row']->status == '1') {
            return view('site.page.' . $page, compact('nav'), $data);
        } else {
            redirect(route('/'));
        }
    }

}
