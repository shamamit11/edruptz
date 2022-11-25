<?php
namespace App\Services\Instructor;


use App\Models\Instructor;
use App\Models\General;
use App\Models\Slug;
use App\Traits\StoreImageTrait;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AccountService
{
    use StoreImageTrait;
    
    public function store($request)
    {
		$id = Auth::guard('instructor')->id();
        $instructor = Instructor::find($id);
        if (isset($request['image'])) {
            $image = $this->StoreImage($request['image'], '/uploads/instructor/');
        } else {
            $image = $request['old_image'];
        }
        $instructor->name = $request['name'];
        $instructor->last_name = $request['last_name'];
        $instructor->image = $image;
        $instructor->about_me = $request['about_me'];
        $instructor->address = $request['location'];
        $instructor->professional = $request['profession'];
        $instructor->city = $request['city'];
        $instructor->state = $request['state'];
        $instructor->zip =  $request['zip'];
        $instructor->save();
        $message = "profile updated";
        return $message;
    }

   

    public function imageDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Instructor::findOrFail($id);
        Storage::disk('public')->delete('/uploads/instructor/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    }

    public function password($request)
    {
       
        if ((Hash::check( $request['old_password'], Auth::guard('instructor')->user()->password)) == false) {
            $message = 'Incorrect email or password provided.';
            return $message;
        } else {
            Instructor::where('id', Auth::guard('instructor')->id())->update(['password' => Hash::make($request['new_password'])]);
            $message = 'Success';
            return $message;
        }
    }
    

}
