@extends('frontend.frontend_master')
@section('main')
<main class="main pages">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Pages <span></span> My Account
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
                                        <h1 class="mb-5">Create an Account</h1>
                                        <p class="mb-30">Already have an account? <a href="{{route('login')}}">Login</a></p>
                                    </div>
                                    <form method="post" action="{{route('register')}}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" required="" name="name" placeholder="Name">
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="email" required="" name="email" placeholder="Email">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" required="" name="contact_number" pattern="01[356789][0-9]{8}" placeholder="Mobile Number">
                                            @error('contact_number')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password" placeholder="Password">
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                        <div class="form-group">
                                            <input required="" type="password" name="password_confirmation" placeholder="Confirm password">
                                            @error('password_confirmation')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                                                              
                                        <div class="form-group mb-30">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up font-weight-bold" name="login">Submit &amp; Register</button>
                                        </div>
                                        <p class="font-xs text-muted"><strong>Note:</strong>Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy</p>
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