<?php

namespace App\Http\Controllers\Module;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Models\Subcategory;
use App\Models\category;

class SubCategoryController extends Controller
{
     //show all categorys 
     public function index()
     {
           $sub=SubCategory::latest()->get();
           //dd($sub);
           return view('admin.subcat.index',compact('sub'));
     }
 
     //Create category 
     public function create()
     {
        $categories=category::orderBy('category_name','asc')->get();
         return view('admin.subcat.create',compact('categories'));
     }
 
     //Store category
     public function store(Request $request)
     {
      //dd($request);
        $request->validate([
         "sub_name"=>"required|min:3",
         "cat_id"=>"required",
 
        ]);    
      //dd($request->category_name,$request->image);
        //For image
      
        //Store Information
        try{
           SubCategory::create([
             "sub_name"=>$request->sub_name,
             "cat_id"=>$request->cat_id,
             "sub_slug"=>strtolower(str_replace(' ','-',$request->sub_name)),
           ]);
          
           return redirect()->route('admin.subcategory.list')->with($this->toaster('success','Successfully Sub category Created!'));
        }catch(Exception $ex){
          // dd( DB::getQueryLog());
           return redirect()->back()->with($this->toaster('error',$ex->getMessage()))->withInput();
        }
     }
 
     //Edit category
     public function edit($id)
     {
          $category=SubCategory::findorfail($id);
          return view('admin.category.edit',compact('category'));  
     }
 
     //Update category
     public function update(Request $request,$id)
     {
              //category
              $categoryInfo=SubCategory::findorfail($id);
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
     public function deleteSubCategory($id)
     {
         $check=SubCategory::findorfail($id);
         try{
             $check->delete();
             return redirect()->back()->with($this->toaster('info','Selected Sub Category has been Successfully Deleted!'));
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
