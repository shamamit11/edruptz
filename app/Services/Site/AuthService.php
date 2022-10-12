<?php
namespace App\Services\Site;

use App\Models\General;
use App\Models\Instructor;
use App\Models\Slug;
use App\Models\Student;
use App\Models\Commission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class AuthService
{
    public function loginStudent($request, $remember_me)
    {
        $check_data = array('email' => $request['email'], 'password' => $request['password']);
        if (Auth::guard('student')->attempt($check_data, $remember_me)) {
            return true;
        } else {
            return false;
        }

    }

    public function loginInstructor($request, $remember_me)
    {
        $check_data = array('email' => $request['email'], 'password' => $request['password']);
        if (Auth::guard('instructor')->attempt($check_data, $remember_me)) {
            return true;
        } else {
            return false;
        }

    }

    public function registerInstructor($request)
    {
        $commission = Commission::where('default', 1)->where('status', 1)->first();
        $verified_code = Str::random(64);
        $slug_name = General::getSlug("instructors", "slug", $request['name']);
        $slug = Slug::insertSlug("Instructor", "InstructorDetail", $slug_name, '');
        $instructor = new Instructor;
        $instructor->name = $request['name'];
        $instructor->email = $request['email'];
        $instructor->password = Hash::make($request['password']);
        $instructor->verified_code = $verified_code;
        $instructor->slug = $slug;
        $instructor->commission = $commission->commission;
        $instructor->save();
        Mail::send('email.instructor', ['token' => $verified_code], function($message) use($request){
            $message->from('noreply@edruptz.com', env('APP_NAME'));
            $message->to($request['email']);
            $message->subject('Email Verification');
          });
  

    }

    public function registerStudent($request)
    {
        $verified_code = Str::random(64);
        $student = new Student;
        $student->name = $request['name'];
        $student->email = $request['email'];
        $student->password = Hash::make($request['password']);
        $student->verified_code = $verified_code;
        $student->save();
        Mail::send('email.student', ['token' => $verified_code], function($message) use($request){
            $message->from('noreply@edruptz.com', env('APP_NAME'));
            $message->to($request['email']);
            $message->subject('Email Verification');
          });
    }

    public function verificationStudent($code)
    {
        $res = Student::where('verified_code', $code)->first();
        if ($res) {
            $res->email_verified = 1;
            $res->save();
            return true;
        } else {
            return false;
        }
    }

    public function verificationInstructor($code)
    {
        $res = Instructor::where('verified_code', $code)->first();
        if ($res) {
            $res->email_verified = 1;
            $res->save();
            return true;
        } else {
            return false;
        }
    }

}
