<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;

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
           $request->validate([]);
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
