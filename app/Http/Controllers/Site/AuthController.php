<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Site\AuthRequest;
use App\Http\Requests\Site\InstructorRegisterRequest;
use App\Http\Requests\Site\StudentRegisterRequest;
use App\Services\Site\AuthService;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthService $AuthService)
    {
        $this->auth = $AuthService;
    }

    public function login()
    {
        if(Auth::guard('instructor')->user()) {
            return redirect()->intended(route('instructor-dashboard'));
        }
        if(Auth::guard('student')->user()) {
            return redirect()->intended(route('student-dashboard'));
        }
        return view('site.auth.login');
    }

    public function register()
    {
        if(Auth::guard('instructor')->user()) {
            return redirect()->intended(route('instructor-dashboard'));
        }
        if(Auth::guard('student')->user()) {
            return redirect()->intended(route('student-dashboard'));
        }
        return view('site.auth.register');
    }

    public function registerStudent(StudentRegisterRequest $request)
    {
        $this->auth->registerStudent($request->validated());
        $message = "Please check your email and click on the link to verify your account.";
		return redirect(route('login'))->withMessage($message); 
		
    }

    public function registerInstructor(InstructorRegisterRequest $request)
    {
        $this->auth->registerInstructor($request->validated());
        $message = "Please check your email and click on the link to verify your account.";
		return redirect(route('login'))->withMessage($message); 
    }

    public function verificationStudent($code)
    {
        $res = $this->auth->verificationStudent($code);
        if ($res) {
            $message = "Email is verified. Please login to continue further";
		    return redirect(route('login'))->withMessage($message); 
        } else {
            $message = "Invaid email verification.";
            return redirect()->back()->withErrors(['error' => $message]);
        }
    }

    public function verificationInstructor($code)
    {
        $res = $this->auth->verificationInstructor($code);
        if ($res) {
            $message = "Email is verified. Please login to continue further";
		    return redirect(route('login'))->withMessage($message); 
        } else {
            $message = "Invaid email verification.";
            return redirect()->back()->withErrors(['error' => $message]);
        }
    }

    public function loginStudent(AuthRequest $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        $res = $this->auth->loginStudent($request->validated(), $remember_me);
        if ($res) {
            return redirect()->intended(route('student-dashboard'));
        } else {
            $message = "Username or Password Not Matched!";
            return redirect()->back()->withErrors(['error' => $message])->withInput($request->only('email'));
        }
    }

    public function loginInstructor(AuthRequest $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        $res = $this->auth->loginInstructor($request->validated(), $remember_me);
        if ($res) {
            return redirect()->intended(route('instructor-dashboard'));
        } else {
            $message = "Username or Password Not Matched!";
            return redirect()->back()->withErrors(['error' => $message])->withInput($request->only('email'));
        }
    }
	

}
