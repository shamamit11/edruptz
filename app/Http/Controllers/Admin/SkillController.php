<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SkillRequest;
use App\Models\Skill;
use App\Models\General;
use App\Services\Admin\SkillService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    protected $skill;

    public function __construct(SkillService $SkillService)
    {
        $this->skill = $SkillService;
    }

    public function index(Request $request)
    {
        $nav = 'skill';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->skill->List($per_page, $page, $q);
        return view('admin.skill.list', compact('nav', 'sub_nav'), $data);
    }

    public function status(Request $request)
    {
        $this->skill->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'skill';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Skill" : "Edit Skill";
        $data['action'] = route('admin-skill-addaction');
        $data['row'] = Skill::where('id', $id)->first();
        return view('admin.skill.add', compact('nav', 'sub_nav'), $data);
    }

    public function addAction(SkillRequest $request)
    {
        $message = $this->skill->store($request->validated());
        return redirect()->route('admin-skill')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->skill->delete($request);
    }
}
