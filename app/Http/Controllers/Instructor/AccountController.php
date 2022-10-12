<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Http\Requests\Instructor\ProfileRequest;
use App\Http\Requests\Instructor\PasswordRequest;
use App\Services\Instructor\AccountService;
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
		$instructor_id = Auth::guard('instructor')->id();
		$data['user'] = Instructor::where('id', $instructor_id)->first();
        $data['profile_action'] = route('instructor-account-addaction');
        $data['password_action'] = route('instructor-account-password');
        return view('instructor.account.index', compact('nav'), $data);
    }

    public function addAction(ProfileRequest $request)
    {
        $message = $this->account->store($request->validated());
        return redirect()->route('instructor-account-setting')->withMessage($message);
    }
	
	public function password(PasswordRequest $request)
    {
        $message = $this->account->password($request->validated());
        return redirect()->route('instructor-account-setting')->withMessage($message);
    }


    public function imageDelete(Request $request)
    {
        echo $this->account->imageDelete($request);
    }
}
