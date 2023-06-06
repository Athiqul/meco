@extends('admin.admin_master');
@section('need-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.10/dist/sweetalert2.min.css">
@endsection
@section('main-content')
<div class="page-wrapper">
<div class="page-content"> 
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Vendor Information</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Vendor Information</li>
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
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('admin.vendor.status',$vendor->id)}}" method="get" id="statusChange">
                                @csrf
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Vendor Username</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" class="form-control"  name="username" value="{{$vendor->username}}" readonly>
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
                                    @enderror" value="{{old('name',$vendor->name)}}" readonly>
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
                                @enderror" value="{{old('email',$vendor->email)}}" readonly>
                                   
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="contact_number" class="form-control @error('contact_number')
                                    {{'is-invalid'}}
                                @enderror" value="{{old('contact_number',$vendor->contact_number)}}" readonly>
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
                                @enderror" value="{{old('address',$vendor->address)}}" readonly>
                                    @error('address')
                                    <span class="text-danger text-center">{{$message}}</span>
                                @enderror
                                </div>
                            </div>
                            
                                    
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Since</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                        <input class=" form-control @error('dob')
                                        {{'is-invalid'}}
                                    @enderror" name="dob" type="text" id="date" placeholder="{{substr($vendor->dob,0,10)}}" value="{{old('dob')}}" data-dtp="dtp_gcHx4" readonly>
                                        @error('dob')
                                        <span class="text-danger text-center">{{$message}}</span>
                                    @enderror
                                        </div>
                                    </div>
                                   
                                    @if (!empty($vendorInfo))
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">About:</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <textarea class="form-control" rows="6" name="desc" readonly>{{old('desc',$vendorInfo->desc??'')}}</textarea>
                                            @error('desc')
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
                                        @enderror" value="{{old('facebook',$vendorInfo->facebook??'')}}" readonly>
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
                                        @enderror" value="{{old('Youtube',$vendorInfo->youtube??'')}}" readonly>
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
                                        @enderror" value="{{old('twitter',$vendorInfo->twitter??'')}}" readonly>
                                            @error('twitter')
                                            <span class="text-danger text-center">{{$message}}</span>
                                        @enderror
                                        </div>
                                    </div>  
                                    @endif
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Account Created</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text"  class="form-control" value="{{$vendor->created_at!=null?date('Y-m-d',strtotime($vendor->created_at)):''}}" readonly>
                                           
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Current Status</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" value="{{$vendor->status=='1'?'Active':'Inactive'}}" readonly>
                                           
                                        </div>
                                    </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                   
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <img src="{{$vendor->image==null?asset('assets/images/profile/no_image.jpg'):asset('assets/images/profile/'.$vendor->image)}}"  id="preview" class="form-control" style="height:100px;width:100px;" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn px-4 {{$vendor->status=='1'?'btn-danger':'btn-success'}}" value="{{$vendor->status=='1'?'Inactive Vendor':'Active Vendor'}}">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
     $(function(){
    $(document).on('submit','#statusChange',function(e){
        e.preventDefault();
        let element=e.target.closest('form');
        var link = element.action;

  
                  Swal.fire({
                    title: 'Are you sure?',
                    text:  "Update the status of this vendor?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Change it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Updated!',
                        'Your Request has been updated.',
                        'success'
                      )
                    }
                  }) 


    });

  });
</script>
    
@endsection