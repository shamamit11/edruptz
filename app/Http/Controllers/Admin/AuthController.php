<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Services\Admin\AuthService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $auth;

    public function __construct(AuthService $AuthService)
    {
        $this->auth = $AuthService;
    }

    public function login()
    {
        return view('admin.auth.login');
    }

    public function checkLogin(AuthRequest $request)
    {
		
        $remember_me = $request->has('remember_me') ? true : false;
        // Attempt to log the user in
        $res = $this->auth->checkLogin($request->validated(), $remember_me);
        if ($res) {
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin-dashboard'));
        } else {
            // if unsuccessful, then redirect back to the login with the form data
            $message = "Username or Password Not Matched!";
            return redirect()->back()->withErrors(['error' => $message])->withInput($request->only('email'));
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin-login'));
    }

}
