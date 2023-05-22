<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Intervention\Image\Facades\Image as Image;

class Admin extends Controller
{
    //Admin Dashboard render
    public function dashboard()
    {
        return view('admin.admin_dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    //View Admin Profile
    public function adminProfile()
    {

        $userId=Auth::user()->id;
        $userData=User::findorfail($userId);
        
        return view('admin.admin_profile',compact('userData'));
    }

    //Admin info update
    public function adminUpdate(Request $request)
    {
        //dd($request);
        $request->validate(
            [
                "image"=>"image|mimes:png,jpg|max:1024",
                "name"=>"required",
                "contact_number"=>"required|numeric",
                "address"=> "required",
                "dob"=>"required",
            ]);
        $userId=Auth::user()->id;
        $userData=User::findorfail($userId);
        if($request->hasFile('image'))
        {
           $file=$request->file('image');
           $profileImageName=md5(uniqid()).'.'.$file->getClientOriginalExtension();
           $path=public_path("assets/images/profile/");
           !is_dir($path)&&mkdir($path,0777,true);
           //remove previous image
           if($userData->image!=null)
           {
            try{
                @unlink($path.$userData->image);
            }catch(Exception $ex)
            {

            }
           
           }
          Image::make($file)->resize(110,110)->save($path.$profileImageName);
          $userData->image=$profileImageName;
                
        }

        $userData->name=$request->name;
        $userData->contact_number=$request->contact_number;
        $userData->address=$request->address;
        $userData->dob=$request->dob;
        $userData->sex=$request->sex;
      
        $userData->save();
         
        return redirect()->back();
        
    }
}
