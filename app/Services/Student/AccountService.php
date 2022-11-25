<?php
namespace App\Services\Student;


use App\Models\Student;
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
		$id = Auth::guard('student')->id();
        $student = Student::find($id);
        if (isset($request['image'])) {
            $image = $this->StoreImage($request['image'], '/uploads/student/');
        } else {
            $image = $request['old_image'];
        }
        $student->name = $request['name'];
        $student->last_name = $request['last_name'];
        $student->image = $image;
        $student->address = $request['country'];
        $student->city = $request['city'];
        $student->state = $request['state'];
        $student->zip =  $request['zip'];
        $student->save();
        $message = "profile updated";
        return $message;
    }

   

    public function imageDelete($request)
    {
        $id = $request->id;
        $field_name = $request->field_name;
        $ras = Student::findOrFail($id);
        Storage::disk('public')->delete('/uploads/student/' . $ras->$field_name);
        $ras->$field_name = '';
        $ras->save();
        return "success";
    }

    public function password($request)
    {
       
        if ((Hash::check( $request['old_password'], Auth::guard('student')->user()->password)) == false) {
            $message = 'Incorrect email or password provided.';
            return $message;
        } else {
            Student::where('id', Auth::guard('student')->id())->update(['password' => Hash::make($request['new_password'])]);
            $message = 'Success';
            return $message;
            
        }
    }
    

}
