<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{

    public function index(Request $request)
    {
        $nav = '';
        if ($request->email) {
            $email = new Email;
            $email->email = $request->email;
            $email->save();
            return redirect('/')->with('message', 'Thank you for contacting. We will contact you asap!');
        }
    }

}
