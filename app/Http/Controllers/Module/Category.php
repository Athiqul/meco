<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category as CatModel;
use Intervention\Image\Facades\Image as CatImage;
use Illuminate\Support\Facades\DB;
use Exception;

class Category extends Controller
{
       //show all categorys 
       public function index()
       {
             $categories=CatModel::latest()->get();
             //dd($categorys);
             return view('admin.category.index',compact('categories'));
       }
   
       //Create category 
       public function create()
       {
           return view('admin.category.create');
       }
   
       //Store category
       public function store(Request $request)
       {
        //dd($request);
          $request->validate([
           "category_name"=>"required|min:3",
           "image"=>"nullable|image|mimes:png,jpg,gif,jpeg|max:2048",
   
          ]);    
        //dd($request->category_name,$request->image);
          //For image
          $image=null;
          if($request->hasFile('image'))
          {
             $file=$request->file('image');
             $image=md5(uniqid()).'.'.$file->getClientOriginalExtension();
             $path=public_path('assets/images/category/');
             !is_dir($path)&&mkdir($path,0777,true);
             CatImage::make($file)->resize(100,100)->save($path.$image);
             
          }
   
          //Store Information
          try{
             CatModel::create([
               "category_name"=>$request->category_name,
               "image"=>$image,
               "category_slug"=>strtolower(str_replace(' ','-',$request->category_name)),
             ]);
            
             return redirect()->route('admin.category.list')->with($this->toaster('success',$image==null?'Sucessfully category Created without Image':'Successfully category Created with Image'));
          }catch(Exception $ex){
            // dd( DB::getQueryLog());
             return redirect()->back()->with($this->toaster('error',$ex->getMessage()))->withInput();
          }
       }
   
       //Edit category
       public function edit($id)
       {
            $category=CatModel::findorfail($id);
            return view('admin.category.edit',compact('category'));  
       }
   
       //Update category
       public function update(Request $request,$id)
       {
                //category
                $categoryInfo=CatModel::findorfail($id);
                //validation
                $request->validate([
                   "category_name"=>"required|min:3",
                   "image"=>"nullable|image|mimes:png,jpg,gif,jpeg|max:2048",
           
                  ]);    
               //Image Handle
               $image=null;
               if($request->hasFile('image'))
               {
                  $file=$request->file('image');
                  $image=md5(uniqid()).'.'.$file->getClientOriginalExtension();
                  $path=public_path('assets/images/category/');
                  !is_dir($path)&&mkdir($path,0777,true);
                  CatImage::make($file)->resize(100,100)->save($path.$image);
                  $categoryInfo->image&&file_exists($path.$categoryInfo->image)&&unlink($path.$categoryInfo->image);
               }
               //Save 
               $categoryInfo->category_name=$request->category_name;
               $categoryInfo->image=$image??$categoryInfo->image;
               //check nothing
               if(!$categoryInfo->isDirty())
               {
                   return redirect()->back()->with($this->toaster('info','Nothing updated! Same data already exist in this record'));
               }
   
               try{
                   $categoryInfo->save();
                   return redirect()->route('admin.category.list')->with($this->toaster('success',$image?'category Information updated with Image':'category Information updated without Image'));
               }catch(Exception $e){
                   return redirect()->back()->with($this->toaster('error',$e->getMessage()));
               }
       }
       //Delete
       public function deletecategory($id)
       {
           $check=CatModel::findorfail($id);
           try{
               $check->delete();
               return redirect()->back()->with($this->toaster('info','Selected category has been Successfully Deleted!'));
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
