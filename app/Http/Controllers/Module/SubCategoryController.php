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
          $subcat=SubCategory::findorfail($id);
          $categories=category::latest()->get();
          return view('admin.subcat.edit',compact('subcat','categories'));  
     }
 
     //Update category
     public function update(Request $request,$id)
     {
              //category
              $subInfo=SubCategory::findorfail($id);
              //validation
              $request->validate([
                 "sub_name"=>"required|min:3",
                 "cat_id"=>"required|exists:categories,id",
         
                ]);    
             
            
             $subInfo->sub_name=$request->sub_name;
             $subInfo->cat_id=$request->cat_id;
             //check nothing
             if(!$subInfo->isDirty())
             {
                 return redirect()->back()->with($this->toaster('info','Nothing updated! Same data already exist in this record'));
             }
 
             try{
                 $subInfo->save();
                 return redirect()->route('admin.subcategory.list')->with($this->toaster('success','Sub Category Information updated'));
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
