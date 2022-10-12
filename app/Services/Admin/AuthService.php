<?php
namespace App\Services\Admin;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function checkLogin($request, $remember_me)
    {
        $check_data = array('email' => $request['email'], 'password' => $request['password']);
        if (Auth::guard('admin')->attempt($check_data, $remember_me)) {
			return true;
        } else {
            return false;
        }
       
    }
}
