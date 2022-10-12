<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Email;
use App\Services\Admin\EmailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    protected $email;

    public function __construct(EmailService $EmailService)
    {
        $this->email = $EmailService;
    }

    public function index(Request $request)
    {
        $nav = 'email';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->email->List($per_page, $page, $q);
        return view('admin.email.list', compact('nav', 'sub_nav'), $data);
    }

    public function delete(Request $request)
    {
        echo $this->email->delete($request);
    }
}
