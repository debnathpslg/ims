<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('storage/assets/images/favicon.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('storage/dist/css/style.min.css') }}" rel="stylesheet">
<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('storage/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box">
                <div>
                    <div class="logo">
                        {{-- <span class="db"><img src="{{ asset('storage/assets/images/logo-icon.png') }}" alt="logo" /></span> --}}
                        <h5 class="font-medium m-b-20">Sign Up to IMS</h5>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal m-t-20" 
                                action="{{ route('validateRegister') }}"
                                method="POST" novalidate>
                                @csrf

                                <div class="form-group row ">
                                    <div class="col-12 ">
                                        <input 
                                            class="form-control form-control-lg text-capitalize @error('name') is-invalid @enderror" 
                                            type="text" 
                                            name="name"
                                            required 
                                            placeholder="Full Name"
                                        />
                                        <div class="invalid-feedback">
                                            @error('name')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-lg text-lowercase @error('email') is-invalid @enderror" 
                                            type="text" 
                                            name="email"
                                            required 
                                            placeholder="Email"
                                        />
                                        <div class="invalid-feedback">
                                            @error('email')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-lg @error('password') is-invalid @enderror" 
                                            type="password" 
                                            name="password"
                                            required 
                                            placeholder="Password"
                                        />
                                        <div class="invalid-feedback">
                                            @error('password')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12 ">
                                        <input class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror" 
                                            type="password" 
                                            name="password_confirmation"
                                            required 
                                            placeholder="Confirm Password"
                                        />
                                        <div class="invalid-feedback">
                                            @error('password_confirmation')
                                            {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group row">
                                    <div class="col-md-12 ">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">I agree to all <a href="javascript:void(0)">Terms</a></label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group text-center ">
                                    <div class="col-xs-12 p-b-20 ">
                                        <button class="btn btn-block btn-lg btn-info " type="submit ">SIGN UP</button>
                                    </div>
                                </div>
                                <div class="form-group m-b-0 m-t-10 ">
                                    <div class="col-sm-12 text-center ">
                                        Already have an account? <a href="{{ route('login') }}" class="text-info m-l-5 "><b>Sign In</b></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('storage/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('storage/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('storage/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script>
        $('[data-toggle="tooltip "]').tooltip();
        $(".preloader ").fadeOut();
    </script>
</body>

</html>