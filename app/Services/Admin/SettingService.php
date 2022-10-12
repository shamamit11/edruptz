<?php
namespace App\Services\Admin;
use App\Models\Setting;
class SettingService
{

    public function store($request)
    {
        //Setting::truncate();
		
        $setting = Setting::first();
        $setting->site_name = $request['site_name'];
        $setting->meta_title = $request['meta_title'];
        $setting->meta_description = $request['meta_description'];
        $setting->google_analytics = $request['google_analytics'];
        $setting->google_site_verification = $request['google_site_verification'];
        $setting->email = $request['email'];
        $setting->instructor_email = $request['instructor_email'];
        $setting->student_email = $request['student_email'];
        $setting->support_email = $request['support_email'];
        $setting->phone = $request['phone'];
        $setting->address = $request['address'];
        $setting->years = $request['years'];
        $setting->map = $request['map'];
        $setting->save();
        $message = "Data updated";
        return $message;
    }
}
