<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
Use Illuminate\Support\Facades\Auth;

class VendorApprove extends Controller
{
    //Show Active Vendor List
    public function activeVendors()
    {
        $vendors=User::where('roles','vendor')->where('status','1')->orderBy('id','desc')->get();
        return view('',compact('vendors'));  
    }
    //Show Inactive Vendor List
    public function inactiveVendors()
    {
        $vendors=User::where('roles','vendor')->where('status','0')->orderBy('id','desc')->get();
        return view('',compact('vendors'));  
    }
    //Approve Vendor or inactive Vendor
    public function vendorApproval($vendorId)
    {
       $vendor=User::findorfail($vendorId);
       $vendor->status= $vendor->status=='1'?'0':'1';
       try{

        $vendor->save();
        return redirect()->back()->with($this->sentToaster('success',$vendor->status=='1'?'Successfully Vendor Account Approve and Activated!':'Successfully Vendor Account Disapprove and Inactivated'));
       }catch(Exception $ex){
            return redirect()->back()->with($this->sentToaster('error',$ex->getMessage()));
       }
    }
    
    //Toaster alert
    private function sentToaster($type,$msg):array
    {
          return [
            'alert-type'=>$type,
            'message'=>$msg
          ];
    }
}
