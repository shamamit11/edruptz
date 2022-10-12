<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Requests\Student\ProfileRequest;
use App\Http\Requests\Student\PasswordRequest;
use App\Services\Student\AccountService;
class AccountController extends Controller 
{
    protected $account;

    public function __construct(AccountService $AccountService)
    {
        $this->account = $AccountService;
    }

    public function index()
    {
        $nav = '';
		$student_id = Auth::guard('student')->id();
		$data['user'] = Student::where('id', $student_id)->first();
        $data['profile_action'] = route('student-account-addaction');
        $data['password_action'] = route('student-account-password');
        return view('student.account.index', compact('nav'), $data);
    }

    public function addAction(ProfileRequest $request)
    {
        $message = $this->account->store($request->validated());
        return redirect()->route('student-account-setting')->withMessage($message);
    }
	
	public function password(PasswordRequest $request)
    {
        $message = $this->account->password($request->validated());
        return redirect()->route('student-account-setting')->withMessage($message);
    }


    public function imageDelete(Request $request)
    {
        echo $this->account->imageDelete($request);
    }
}
