

@extends('frontend.frontend_master')
@section('main')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span>Forget password
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
                                    <div class="heading_s1">
                                        <h1 class="mb-5">Forget Password?</h1>
                                        <p class="mb-30">No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.</p>
                                    </div>
                                  <span class="text-success">{{session('status')}}</span>
                                    <form method="post" action="{{route('password.email')}}">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <input type="email" required="" name="email" placeholder="Email">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                        
                                                                              
                                        <div class="form-group mb-30">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Email Password Reset Link</button>
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