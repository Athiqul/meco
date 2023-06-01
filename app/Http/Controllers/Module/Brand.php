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
          return redirect()->back()->with($this->toaster('success',$image==null?'Sucessfully Brand Created without Image':'Successfully Brand Created with Image'));
       }catch(Exception $ex){
          return redirect()->back()->with('error',$ex->getMessage());
       }
    }

    //Edit Brand
    public function edit($id)
    {

    }

    //Update Brand
    public function update(Request $request,$id)
    {

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
