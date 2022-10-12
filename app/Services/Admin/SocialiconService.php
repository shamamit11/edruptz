<?php
namespace App\Services\Admin;
use App\Models\Socialicon;
class SocialiconService
{

    public function store($request)
    {
        Socialicon::truncate();
        $socialicon = new Socialicon;
        $socialicon->facebook = $request['facebook'];
        $socialicon->twitter = $request['twitter'];
        $socialicon->linkedin = $request['linkedin'];
        $socialicon->instagram = $request['instagram'];
        $socialicon->youtube = $request['youtube'];
        $socialicon->whatsapp = $request['whatsapp'];
        $socialicon->pinterest = $request['pinterest'];
        $socialicon->save();
        $message = "Data updated";
        return $message;
    }
}
