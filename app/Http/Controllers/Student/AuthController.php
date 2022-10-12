<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	
    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect(route('login'));
    }

}
