<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\General;
use App\Services\Admin\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    protected $student;

    public function __construct(StudentService $StudentService)
    {
        $this->student = $StudentService;
    }

    public function index(Request $request)
    {
        $nav = 'student';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->student->List($per_page, $page, $q);
        return view('admin.student.list', compact('nav', 'sub_nav'), $data);
    }
}
