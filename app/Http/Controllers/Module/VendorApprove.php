<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use App\Models\vendorInfo;
Use Illuminate\Support\Facades\Auth;

class VendorApprove extends Controller
{

    //Vendor Registration
    public function vendorRegister()
    {
        return view('auth.vendor_signup');
    }

    //Store Vendor Information
    public function storeVendor()
    {
        
    }
    //Vendor Information Save
    //Vendor Profile
    public function vendorProfile($id)
    {
       $vendor=User::where('roles','vendor')->findorfail($id);

       //find more info
       $vendorInfo=vendorInfo::where('vendor_id',$id)->first();
       return view('admin.vendors.vendor_profile',compact('vendor','vendorInfo')); 
    }
    //Show Active Vendor List
    public function activeVendors()
    {
        $vendors=User::where('roles','vendor')->where('status','1')->orderBy('id','desc')->get();
        return view('admin.vendors.active_vendor',compact('vendors'));  
    }
    //Show Inactive Vendor List
    public function inactiveVendors()
    {
        $vendors=User::where('roles','vendor')->where('status','0')->orderBy('id','desc')->get();
        return view('admin.vendors.inactive_vendor',compact('vendors'));  
    }
    //Approve Vendor or inactive Vendor
    public function vendorApproval($vendorId)
    {
       $vendor=User::findorfail($vendorId);
       $vendor->status= $vendor->status=='1'?'0':'1';
       try{

        $vendor->save();
        $routeName=$vendor->status=='1'?'admin.active.vendors':'admin.inactive.vendors';
        return redirect()->route($routeName)->with($this->sentToaster('success',$vendor->status=='1'?'Successfully Vendor Account Approve and Activated!':'Successfully Vendor Account Disapprove and Inactivated'));
       }catch(Exception $ex){
            return redirect()->back()->with($this->sentToaster('error',$ex->getMessage()));
       }
    }
    
    //Toaster alert
    private function sentToaster($type,$msg):array
    {
          return [
            'alert-type'=>$type,
            'message'=>$msg,
          ];
    }
}
