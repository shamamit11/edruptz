<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\AuthRequest;
use App\Http\Requests\Site\InstructorPasswordRequest;
use App\Http\Requests\Site\InstructorRegisterRequest;
use App\Http\Requests\Site\StudentPasswordRequest;
use App\Http\Requests\Site\StudentRegisterRequest; 
use App\Http\Requests\Site\ResetPasswordRequest;  
use App\Models\Instructor;
use App\Models\Student;
use App\Services\Site\AuthService;
use Illuminate\Support\Facades\Auth;
use Mail;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthService $AuthService)
    {
        $this->auth = $AuthService;
    }

    public function login()
    {
        if (Auth::guard('instructor')->user()) {
            return redirect()->intended(route('instructor-dashboard'));
        }
        if (Auth::guard('student')->user()) {
            return redirect()->intended(route('/'));
        }
        return view('site.auth.login');
    }

    public function register()
    {
        if (Auth::guard('instructor')->user()) {
            return redirect()->intended(route('instructor-dashboard'));
        }
        if (Auth::guard('student')->user()) {
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
            $id = Auth::guard('student')->id();
            $student = Student::find($id);
            if ($student->email_verified == 0) {
                Auth::guard('student')->logout();
                $message = "Email is not verified. Please check your email for Verification Link. ";
                Mail::send('email.student', ['token' => $student->verified_code], function($message) use($request, $student){
                    $message->from('noreply@edruptz.com', env('APP_NAME'));
                    $message->to($student->email);
                    $message->subject('Email Verification from Edruptz');
                });
                return redirect()->back()->withErrors(['error' => $message])->withInput($request->only('email'));
            }
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
            $id = Auth::guard('instructor')->id();
            $instructor = Instructor::find($id);
            
            if ($instructor->email_verified == 0) {
                Auth::guard('instructor')->logout();
                $message = "Email is not verified. Please check your email for Verification Link. ";

                Mail::send('email.instructor', ['token' => $instructor->verified_code], function($message) use($request, $instructor){
                    $message->from('noreply@edruptz.com', env('APP_NAME'));
                    $message->to($instructor->email);
                    $message->subject('Email Verification from Edruptz');
                });

                return redirect()->back()->withErrors(['error' => $message])->withInput($request->only('email'));
            }
            return redirect()->intended(route('instructor-dashboard'));
        } else {
            $message = "Username or Password Not Matched!";
            return redirect()->back()->withErrors(['error' => $message])->withInput($request->only('email'));
        }
    }

    

    public function passwordInstructor()
    {
        if (Auth::guard('instructor')->user()) {
            return redirect()->intended(route('instructor-dashboard'));
        }
        return view('site.auth.password_instructor');
    }

    public function forgotPasswordInstructor(InstructorPasswordRequest $request)
    {
        $this->auth->passwordInstructor($request->validated());
        $message = "Please check your email to reset password.";
        return redirect(route('login'))->withMessage($message);
    }
    
    public function resetPasswordInstructor($token)
    {
        $title = 'Reset Password';
        return view('site.auth.reset_password_instructor', ['token' => $token]);
    }

    public function savePasswordInstructor(ResetPasswordRequest $request)
    {
        $message = $this->auth->savePasswordInstructor($request->validated());
        if ($message == 'success') {
            $message = "Password changed successfully!";
            return redirect(route('login'))->withMessage($message);
        } else {
            return back()->withErrors(['error' => "Invalid token!"]);
        }
    }

    //forget password student

    public function passwordStudent()
    {
        if (Auth::guard('student')->user()) {
            return redirect()->intended(route('student-dashboard'));
        }
        return view('site.auth.password_student');

    }

    public function forgotPasswordStudent(StudentPasswordRequest $request)
    {
        $this->auth->passwordStudent($request->validated());
        $message = "Please check your email to reset password.";
        return redirect(route('login'))->withMessage($message);
    }
    
    public function resetPasswordStudent($token)
    {
        $title = 'Reset Password';
        return view('site.auth.reset_password_student', ['token' => $token]);
    }

    public function savePasswordStudent(ResetPasswordRequest $request)
    {
        $message = $this->auth->savePasswordStudent($request->validated());
        if ($message == 'success') {
            $message = "Password changed successfully!";
            return redirect(route('login'))->withMessage($message);
        } else {
            return back()->withErrors(['error' => "Invalid token!"]);
        }
    }

}
