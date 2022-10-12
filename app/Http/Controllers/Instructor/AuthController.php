<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	
    public function logout()
    {
        Auth::guard('instructor')->logout();
        return redirect(route('login'));
    }

}
