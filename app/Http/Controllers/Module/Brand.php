<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\brand as BrandModel;
use Exception;
use Intervention\Image\Facades\Image as BrandImage;


class Brand extends Controller
{
    //show all brands 
    public function index()
    {
          $brands=BrandModel::latest()->get();
          //dd($brands);
          return view('admin.brand.index',compact('brands'));
    }

    //Create Brand 
    public function create()
    {
        return view('admin.brand.create');
    }

    //Store Brand
    public function store(Request $request)
    {
       $request->validate([
        "brand_name"=>"required|min:3",
        "image"=>"nullable|image|mimes:png,jpg,gif,jpeg|max:2048",

       ]);    

       //For image
       $image=null;
       if($request->hasFile('image'))
       {
          $file=$request->file('image');
          $image=md5(uniqid()).'.'.$file->getClientOriginalExtension();
          $path=public_path('assets/images/brand/');
          !is_dir($path)&&mkdir($path,0777,true);
          BrandImage::make($file)->resize(100,100)->save($path.$image);
          
       }

       //Store Information
       try{
          BrandModel::create([
            "brand_name"=>$request->brand_name,
            "image"=>$image,
            "brand_slug"=>strtolower(str_replace(' ','-',$request->brand_name)),
          ]);
          return redirect()->route('admin.brand.list')->with($this->toaster('success',$image==null?'Sucessfully Brand Created without Image':'Successfully Brand Created with Image'));
       }catch(Exception $ex){
          return redirect()->back()->with('error',$ex->getMessage());
       }
    }

    //Edit Brand
    public function edit($id)
    {
         $brand=BrandModel::findorfail($id);
         return view('admin.brand.edit',compact('brand'));  
    }

    //Update Brand
    public function update(Request $request,$id)
    {
             //brand
             $brandInfo=BrandModel::findorfail($id);
             //validation
             $request->validate([
                "brand_name"=>"required|min:3",
                "image"=>"nullable|image|mimes:png,jpg,gif,jpeg|max:2048",
        
               ]);    
            //Image Handle
            $image=null;
            if($request->hasFile('image'))
            {
               $file=$request->file('image');
               $image=md5(uniqid()).'.'.$file->getClientOriginalExtension();
               $path=public_path('assets/images/brand/');
               !is_dir($path)&&mkdir($path,0777,true);
               BrandImage::make($file)->resize(100,100)->save($path.$image);
               $brandInfo->image&&file_exists($path.$brandInfo->image)&&unlink($path.$brandInfo->image);
            }
            //Save 
            $brandInfo->brand_name=$request->brand_name;
            $brandInfo->image=$image??$brandInfo->image;
            //check nothing
            if(!$brandInfo->isDirty())
            {
                return redirect()->back()->with($this->toaster('info','Nothing updated! Same data already exist in this record'));
            }

            try{
                $brandInfo->save();
                return redirect()->route('admin.brand.list')->with($this->toaster('success',$image?'Brand Information updated with Image':'Brand Information updated without Image'));
            }catch(Exception $e){
                return redirect()->back()->with($this->toaster('error',$e->getMessage()));
            }
    }
    //Delete
    public function deleteBrand($id)
    {
        $check=BrandModel::findorfail($id);
        try{
            $check->delete();
            return redirect()->back()->with($this->toaster('info','Selected Brand has been Successfully Deleted!'));
        }catch(Exception $ex){
            return redirect()->back()->with($this->toaster('error',$ex->getMessage()));
        } 
    }
    //noti
    private function toaster($type,$msg):array
    {
        return [
            "alert-type"=>$type,
            "message"=>$msg,
        ];
    }

}
