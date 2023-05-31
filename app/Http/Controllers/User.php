<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;
use Intervention\Image\Facades\Image as ProfileImage;
use Illuminate\Support\Facades\Validator;
use Exception;

class User extends Controller
{
    public function dashboard()
    {
        $userId=Auth::user()->id;
        $userInfo=UserModel::findorfail($userId);
        return view('user.user_dashboard',compact('userInfo'));
    }
    //User Information update
    public function infoStore(Request $request)
    {
        //get user info
        $userId=Auth::user()->id;
        $userInfo=UserModel::findorfail($userId);

        //user Validation
        $validator=Validator::make($request->all(),[
            "name"=>"required|min:4",
            "username"=>"required|min:3",
            "image"=>"mimes:jpeg,png,jpg,gif,webp|max:2048",
            "dob"=>"required",
            "address"=>"required",
            "contact_number"=>[
                "required",
                'regex:/^(?:\+?88|0)[1-9][0-9]{9}$/',
            ],
        ]);
        if($validator->fails())
        {
            return redirect()->back()->withInput()->withErrors($validator)->with('link','account');
        }
        //    $request->validate([
        //     "name"=>"required|min:4",
        //     "username"=>"required|min:3",
        //     "image"=>"mimes:jpeg,png,jpg,gif,webp|max:2048",
        //     "dob"=>"required",
        //     "address"=>"required",
        //     "contact_number"=>[
        //         "required",
        //         'regex:/^(?:\+?88|0)[1-9][0-9]{9}$/',
        //     ],
            
        //    ]);
           
           //Check Mobile number new or old
           //dd($userInfo->contact_number,$request->contact_number);
          if($userInfo->contact_number!=$request->contact_number)
          {
              //check it is unique number or not
              $check=UserModel::where('contact_number',$request->contact_number)->first();

              if($check!=null)
              {
                return redirect()->back()->withInput()->with($this->sentToaster('error','This contact number already used try with another one'))->with('link','account');
              }
          }
          //check user name
          if($userInfo->username!=$request->username)
          {
              //check it is unique number or not
              $check=UserModel::where('username',$request->username)->first();

              if($check!=null)
              {
                return redirect()->back()->withInput()->with($this->sentToaster('error','This username already used try with another one'))->with('link','account');
              }
          }
          //Image process
          $imageName=null;
          if($request->hasFile('image'))
          {
             $file=$request->file('image');
             $imageName=md5(uniqid()).'.'.$file->getClientOriginalExtension();
             $path=public_path('assets/images/profile/');
             !is_dir($path)&&mkdir($path,0777,true);
             //old Image check and remove
             file_exists($path.$userInfo->image) && @unlink($path.$userInfo->image);
             
            ProfileImage::make($file)->resize(110,110)->save($path.$imageName);

          }
          //Store information
          $userInfo->name=$request->name;
          $userInfo->username=$request->username;
          $userInfo->contact_number=$request->contact_number;
          $userInfo->dob=$request->dob;
          $userInfo->sex=$request->sex;
          $userInfo->address=$request->address;
          $userInfo->image=$imageName??$userInfo->image;
          if(!$userInfo->isDirty())
          {
            return redirect()->back()->with($this->sentToaster('info','Nothing Updated!'))->with('link','account');
          }
          try{
            $userInfo->save();
            return redirect()->back()->with($this->sentToaster('success','Successfully profile information updated!'))->with('link','account');
          }catch(Exception $e){
            return redirect()->back()->with($this->sentToaster('error',$e->getMessage()))->with('link','account');
          }
    }

    //Password Change
    public function changePassword(Request $request)
    {
         //get user info
         $userId=Auth::user()->id;
         $userInfo=UserModel::findorfail($userId);
 
         //user Validation
         $validator=Validator::make($request->all(),[
             "curr_password"=>"required",
             "new_password"=>"required|min:6",
             "confirm_password"=>"required|same:new_password",
         ]);
         if($validator->fails())
         {
             return redirect()->back()->withInput()->withErrors($validator)->with('password','account');
         }

         //verify password
         if(!Hash::check($request->curr_password,$userInfo->password))
         {
             return redirect()->back()->with('password','account')->with($this->sentToaster('error','Current password does not matching with existing password!'));
         }

       
          if(Hash::check($request->new_password,$userInfo->password)){
            return redirect()->back()->with('password','account')->with($this->sentToaster('info','Nothing Updated this is already existing password!'));
          } 
         try{
              //store password
         $userInfo->password=$request->new_password;
            $userInfo->save();
            return redirect()->back()->with($this->sentToaster('success','Password Updated Please log in with this password again'));
         }catch(Exception $e){
            return redirect()->back()->with($this->sentToaster('error',$e->getMessage()));
         }
         
    }
    //User Logout
    public function userLogout(Request $request)
    {
       
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with($this->sentToaster('success','Successfully Logout!'));
    }

    //sent toaster notification
    private function sentToaster($type,$msg):array
    {
        return [
            "alert-type"=>$type,
            "message"=>$msg,
        ];   
    }
}
