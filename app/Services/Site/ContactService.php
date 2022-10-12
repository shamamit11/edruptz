<?php
namespace App\Services\Site;

use App\Models\Setting;
use Illuminate\Support\Facades\Mail;

class ContactService
{

    public function sentEmail($request)
    {
        $edata = array(
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
            'country' => $request['country'],
            'messages' => $request['message'],
        );
        $to_email = Setting::first()->email;
        Mail::send('email.contact', $edata, function ($message) use ($to_email) {
            $message->from('noreply@info@edruptz.com', env('APP_NAME'));
            $message->to($to_email);
            $message->subject('Contact');
        });
    }

}
