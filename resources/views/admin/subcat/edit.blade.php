@extends('admin.admin_master')

@section('main-content')
<div class="page-wrapper">
    <div class="page-content"> 
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.category.list')}}"><i class="bx bx-briefcase-alt" title="category list"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit category</li>
                    </ol>
                </nav>
            </div>
           
        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{route('admin.category.update',$category->id)}}" id="category" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Category Name:</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary  form-group">
                                        <input type="text" class="form-control"  name="category_name" value="{{old('category_name',$category->category_name)}}">

                                        @error('category_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                               
                              
                               
                                       
                                    
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Image</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" name="image" onchange="previewImage(event)" class="form-control" >
                                        @error('image')
                                        <span class="text-danger text-center">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                       
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img src="{{$category->image?asset('assets/images/category/'.$category->image):asset('assets/images/profile/no_image.jpg')}}"  id="preview" class="form-control" style="height:100px;width:100px;" alt="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Update">
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('need-js')
<script src="{{asset('assets/js/validate.min.js')}}"></script>

    <script>
        //Validation
        $(document).ready(function (){
        $('#category').validate({
            rules: {
                category_name: {
                    required : true,
                    minlength:3,
                }, 
            },
        
            messages :{
                category_name: {
                    required : 'Please Write category Name',
                    minlength:'Too short name!'
                },
               
            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
         //Preview Image
 function previewImage(event) {
      var input = event.target;
      var reader = new FileReader();
      reader.onload = function(){
        var dataURL = reader.result;
        var preview = document.getElementById('preview');
        preview.src = dataURL;
      };
      reader.readAsDataURL(input.files[0]);
    
    }
    </script>
@endsection