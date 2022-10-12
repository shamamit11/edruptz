<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Search;
use App\Models\General;
use App\Services\Admin\SearchService;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $search;

    public function __construct(SearchService $SearchService)
    {
        $this->search = $SearchService;
    }

    public function index(Request $request)
    {
        $nav = 'search';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->search->List($per_page, $page, $q);
        return view('admin.search.list', compact('nav', 'sub_nav'), $data);
    }
}
