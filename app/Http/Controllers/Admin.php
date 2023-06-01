<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Hash;

use function PHPUnit\Framework\isEmpty;

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

        return redirect('/enterprise-login');
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
                "image"=>"mimes:jpeg,png,jpg,gif,webp|max:1024",
                "name"=>"required",
                "contact_number"=>[
                    "required",
                    'regex:/^(?:\+?88|0)[1-9][0-9]{9}$/',
                ],
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
         
                
        }

        $userData->name=$request->name;
        $userData->contact_number=$request->contact_number;
        $userData->address=$request->address;
        $userData->dob=$request->dob;
        $userData->sex=$request->sex;
        $userData->image=$profileImageName??$userData->image;

        
        if(!$userData->isDirty()){
            return redirect()->back()->with($this->sentToaster('info','Nothing Updated'));
        }
       //check new number is okay or not
        $check=User::where('contact_number',$request->contact_number)->first();
        
        if($check==null)
        {
             return redirect()->back()->withInput()->with($this->sentToaster('error','Update failed contact number already belogs to another account'));
        }

        $userData->save();
         
        return redirect()->back()->with($this->sentToaster('success','Profile Successfully Updated!'));
        
    }


    //Admin Change Password
    public function changePassword()
    {
            return view('admin.admin_password');
    }

    //admin Password store
    public function storePassword(Request $request)
    {
        $userId=Auth::user()->id;
        $userData=User::findorfail($userId);

        $request->validate([
            "old_password"=>'required',
            "new_password"=>"required|min:8",
            "confirm_password"=>"required|same:new_password"
        ]);

        //Check old Password

        //dd($userData->password,' ',Hash::make(($request->old_password)), ' ',$request->old_password);
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return redirect()->back()->withInput()->with($this->sentToaster('error', 'Current Password is Wrong. Please provide a valid password!'));
        }
        // Set Up new Password
       $userData->password=Hash::make($request->new_password);
       try{
        $userData->save();
        return redirect()->back()->withInput()->with($this->sentToaster('success','Password is updated please login again'));
       }catch(Exception $ex){
        return redirect()->back()->withInput()->with($this->sentToaster('error',$ex->getMessage()));
       } 
    }

    private function sentToaster($type,$msg):array
    {
        return [
            "alert-type"=>$type,
            "message"=>$msg,
        ];   
    }

}
