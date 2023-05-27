<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

Use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image as ProfileImage;
use Exception;
use App\Models\vendorInfo;

class Vendor extends Controller
{
    public function dashboard()
    {
        return view('vendors.vendor_dashboard');
    }


    //Vendor Profile
    public function vendorProfile()
    {
        $userId=Auth::user()->id;
        $userInfo=User::findorfail($userId);
        $vendorInfo=vendorInfo::where('vendor_id',$userId)->first();
        return view('vendors.vendor_profile',compact('userInfo','vendorInfo'));

    }

    //Profile Update
    public function updateProfile(Request $request)
    {
        $userId=Auth::user()->id;
        $userInfo=User::findorfail($userId);
         $request->validate([
            "image"=>"mimes:jpeg,png,jpg,gif,webp|max:1024",
            "name"=>"required",
                "contact_number"=>[
                    "required",
                    'regex:/^(?:\+?88|0)[1-9][0-9]{9}$/',
                    
                ],
            "address"=> "required",
              
         ]); 

         if($request->hasFile('image'))
         {
            $file=$request->file('image');
            $profileImageName=md5(uniqid()).'.'.$file->getClientOriginalExtension();
            $path=public_path("assets/images/profile/");
            !is_dir($path)&&mkdir($path,0777,true);
            //remove previous image
            if($userInfo->image!=null)
            {
             try{
                 @unlink($path.$userInfo->image);
             }catch(Exception $ex)
             {
 
             }
            
            }
           ProfileImage::make($file)->resize(110,110)->save($path.$profileImageName);
          
                 
         }

         $userInfo->contact_number=$request->contact_number;
         $userInfo->address=$request->address;
         $userInfo->dob=$request->dob;
         $userInfo->image=$profileImageName??$userInfo->image;
         //check vendor info 
         
         try{
            $vendorInfo=vendorInfo::where('vendor_id',$userId)->first();
            if($vendorInfo==null)
            {
                vendorInfo::create([
                   'facebook'=>$request->facebook,
                   'youtube'=>$request->youtube,
                   'twitter'=>$request->twitter,
                   'desc'=>$request->desc,
                   'vendor_id'=>$userId,
                ]);
                $userInfo->save();
                return redirect()->back()->with($this->sentToaster('success','Successfully Profile Updated!'));
            }
                        $vendorInfo->facebook=$request->facebook;
                        $vendorInfo->youtube=$request->youtube;
                        $vendorInfo->twitter=$request->twitter;
                        $vendorInfo->desc=$request->desc;
                      
            // dd($userInfo->getOriginal(),$userInfo->getAttributes() ,$userInfo->isDirty(),$vendorInfo->isDirty());
           if($userInfo->isDirty()||$vendorInfo->isDirty())
           {
            $userInfo->save();
            $vendorInfo->save();
            return redirect()->back()->with($this->sentToaster('success','Successfully Profile Updated!'));
           }   
         
           return redirect()->back()->with($this->sentToaster('info','Nothing Updated!'));

         }catch(Exception $e){
            return redirect()->back()->with($this->sentToaster('error',$e->getMessage()))->withInput();
         }
    }

    //Password Change
    public function passwordChange()
    {
         return view('vendors.vendor_password');
    }

    public function passwordStore(Request $request)
    {
          //check user
          $userId=Auth::user()->id;
          $userData=User::findorfail($userId);
          //validation
          $request->validate([
            "old_password"=>"required",
            "new_password"=>"required|min:8",
            "confirm_password"=>"required|same:new_password",
          ]);

          //check current password
          if(!Hash::check($request->old_password,$userData->password))
          {
              return redirect()->back()->with($this->sentToaster('error','Current Password is Wrong! please provide valid password'));
          }
          if(Hash::check($request->new_password,$userData->password))
          {
            return redirect()->back()->with($this->sentToaster('info','Your current password and new password are same!'));
          }
          $userData->password=Hash::make($request->new_password);
          try{
            $userData->save();
            return redirect()->back()->with($this->sentToaster('success','Your Password is updated you can login with this password highly reccommend to logout and login again'));
          }catch(Exception $e){
            return redirect()->back()->with($this->sentToaster('error',$e->getMessage()));
          }

          //store password

    }
    //vendor Logout


    public function vendorLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    private function sentToaster($type,$msg):array
    {
        return [
            "alert-type"=>$type,
            "message"=>$msg,
        ];   
    }

}
