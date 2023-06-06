@extends('admin.admin_master')

@section('main-content')
<div class="page-wrapper">
    <div class="page-content"> 
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Sub Category</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route('admin.subcategory.list')}}"><i class="bx bx-briefcase-alt" title="category list"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Sub category</li>
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
                                <form action="{{route('admin.subcategory.update',$subcat->id)}}" id="category" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Sub Category Name:</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary  form-group">
                                        <input type="text" class="form-control"  name="sub_name" value="{{old('sub_name',$subcat->sub_name)}}">

                                        @error('sub_name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                               
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Selected Category:</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary  form-group">
                                        <select class="form-control mb-3" name="cat_id" aria-label="Default select example" required="" >
                                          
                                             @foreach ($categories as  $item)
                                                 <option value="{{$item->id}}" {{$subcat->cat_id==$item->id?'selected':''}}>{{$item->category_name}}</option>
                                             @endforeach
                                        </select>
                                        @error('cat_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
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
                sub_name: {
                    required : true,
                    minlength:3,
                }, 
            },
        
            messages :{
                sub_name: {
                    required : 'Please Write Sub Category Name',
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

    </script>
@endsection