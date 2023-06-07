@extends('vendors.vendor_master');
@section('need-css')

<link href="{{asset('assets/plugins/datetimepicker/css/classic.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/datetimepicker/css/classic.time.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/datetimepicker/css/classic.date.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/datetimepicker/css/classic.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	
@endsection
@section('main-content')
<div class="page-wrapper">
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor Profile</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{route('vendor.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Profile</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-primary">Settings</button>
                <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                    <a class="dropdown-item" href="javascript:;">Another action</a>
                    <a class="dropdown-item" href="javascript:;">Something else here</a>
                    <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                </div>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{$userInfo->image==null?asset('assets/images/profile/no_image.jpg'):asset('assets/images/profile/'.$userInfo->image)}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                                <div class="mt-3">
                                    <h4>{{$userInfo->name}}</h4>
                                    <p class="text-secondary mb-1">{{$userInfo->username}}</p>
                                    <p class="text-muted font-size-sm">{{$userInfo->address}}</p>
                                    
                                </div>
                            </div>
                            <hr class="my-4">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe me-2 icon-inline"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>Website</h6>
                                    <span class="text-secondary">https://codervent.com</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0 text-primary"><i class="lni lni-facebook-original"></i> Facebook</h6>
                                    <span class="text-secondary">{{$vendorInfo->facebook??''}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0 text-info"><i class="lni lni-twitter-original"></i> Twitter</h6>
                                    <span class="text-secondary">{{$vendorInfo->twitter??''}}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0 text-danger"><i class="lni lni-youtube"></i>Youtube</h6>
                                    <span class="text-secondary">{{$vendorInfo->youtube??''}}</span>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('vendor.update.profile')}}" method="post" enctype="multipart/form-data">
                                @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control"  name="username" value="{{$userInfo->username}}" readonly>
                                    @error('username')
                                        
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="name" class="form-control @error('name')
                                        {{'is-invalid'}}
                                    @enderror" value="{{old('name',$userInfo->name)}}">
                                    @error('name')
                                        <span class="text-danger text-center">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="email" class="form-control @error('email')
                                    {{'is-invalid'}}
                                @enderror" value="{{old('email',$userInfo->email)}}" readonly>
                                   
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="contact_number" class="form-control @error('contact_number')
                                    {{'is-invalid'}}
                                @enderror" value="{{old('contact_number',$userInfo->contact_number)}}">
                                    @error('contact_number')
                                    <span class="text-danger text-center">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                           
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="address" class="form-control @error('address')
                                    {{'is-invalid'}}
                                @enderror" value="{{old('address',$userInfo->address)}}">
                                    @error('address')
                                    <span class="text-danger text-center">{{$message}}</span>
                                @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">About:</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <textarea class="form-control" rows="6" name="desc">{{old('desc',$vendorInfo->desc??'')}}</textarea>
                                    @error('desc')
                                    <span class="text-danger text-center">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                            
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Since:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                        <input class=" form-control @error('dob')
                                        {{'is-invalid'}}
                                    @enderror" name="dob" type="text" id="date" value="{{old('dob',substr($userInfo->dob,0,10))}}" data-dtp="dtp_gcHx4">
                                        @error('dob')
                                        <span class="text-danger text-center">{{$message}}</span>
                                    @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Facebook Link</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="url" name="facebook" class="form-control @error('facebook')
                                            {{'is-invalid'}}
                                        @enderror" value="{{old('facebook',$vendorInfo->facebook??'')}}">
                                            @error('facebook')
                                            <span class="text-danger text-center">{{$message}}</span>
                                        @enderror
                                        </div>
                                    </div>   
                                   
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Youtube Link</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="url" name="youtube" class="form-control @error('youtube')
                                            {{'is-invalid'}}
                                        @enderror" value="{{old('Youtube',$vendorInfo->youtube??'')}}">
                                            @error('Youtube')
                                            <span class="text-danger text-center">{{$message}}</span>
                                        @enderror
                                        </div>
                                    </div>  

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Twitter Link</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="url" name="twitter" class="form-control @error('facebook')
                                            {{'is-invalid'}}
                                        @enderror" value="{{old('twitter',$vendorInfo->twitter??'')}}">
                                            @error('twitter')
                                            <span class="text-danger text-center">{{$message}}</span>
                                        @enderror
                                        </div>
                                    </div>  
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Image</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file" name="image" onchange="previewImage(event)" class="form-control @error('image')
                                    {{'is-invalid'}}
                                @enderror" >
                                    @error('image')
                                    <span class="text-danger text-center">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                   
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img src="{{$userInfo->image==null?asset('assets/images/profile/no_image.jpg'):asset('assets/images/profile/'.$userInfo->image)}}"  id="preview" class="form-control" style="height:100px;width:100px;" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Save Changes">
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

<script src="{{asset('assets/plugins/datetimepicker/js/legacy.js')}}"></script>
<script src="{{asset('assets/plugins/datetimepicker/js/picker.js')}}"></script>
<script src="{{asset('assets/plugins/datetimepicker/js/picker.time.js')}}"></script>
<script src="{{asset('assets/plugins/datetimepicker/js/picker.date.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js')}}"></script>
<script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js')}}"></script>
<script>
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: true
    }),
    $('.timepicker').pickatime()
</script>
<script>
    $(function () {
        $('#date-time').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#date').bootstrapMaterialDatePicker({
            time: false
        });
        $('#time').bootstrapMaterialDatePicker({
            date: false,
            format: 'HH:mm'
        });
    });

 //Preview Image
 function previewImage(event) {
      var input = event.target;
      console.log(input);
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