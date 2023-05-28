

@extends('frontend.frontend_master')
@section('main')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span>Reset password
            </div>
        </div>
    </div>
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">
                        <div class="col-lg-10 col-md-10">
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    
                                  <span class="text-success">{{session('status')}}</span>
                                    <form method="post" action="{{route('password.store')}}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                        <div class="form-group">
                                            <input type="email" required="" name="email" value="{{old('email',$request->email)}}"  autofocus >
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>

                                        <div class="form-group">
                                            <input type="password" required="" placeholder="New Password" name="password" >
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" placeholder="Confirm Password" required="" name="password_confirmation" >
                                            @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                                                              
                                        <div class="form-group mb-30">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Reset Password</button>
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
</main>
@endsection
