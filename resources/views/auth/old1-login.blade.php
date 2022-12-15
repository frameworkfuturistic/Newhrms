<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <title>HRMS</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/logo.png') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginPageCss/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginPageCss/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginPageCss/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginPageCss/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginPageCss/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginPageCss/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginPageCss/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginPageCss/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="loginPageCss/css/util.css">
    <link rel="stylesheet" type="text/css" href="loginPageCss/css/main.css">
    <!--===============================================================================================-->
    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>

</head>

<body>
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="limiter">
        <div class="container-login100 bg-success">
            <div class="wrap-login100">
                <span class="login100-form-title p-b-6 font-bold">
                    <h3>बिहार ग्राम स्वराज योजना सोसाइटी</h3>
                </span>
                <form method="POST" action="{{ route('login') }}" class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title p-b-6">
                        <img src="images/logo.png" class="img-fluid" height="200px" width="200px" />
                    </span>
                    <span class="login100-form-title p-b-12">
                        <p class="text-dark mt-1">Log in BGSYS HRMS account</p>
                    </span>

                    <div class="wrap-input100 validate-input text-dark" data-validate="Valid email is: a@b.c">
                        <input class="input100 @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <!-- <span class="focus-input100" data-placeholder="Email"></span> -->
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="password">
                        <!-- <span class="focus-input100" data-placeholder="Password"></span> -->
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="container-login10-form-btn ">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>
                    <div class="flex justify-content-center mt-2">
                        <span class="text-sm ml-2  hover:text-blue-500 cursor-pointer hover:-translate-y-1 duration-500 transition-all"><a class="right" href="{{ route('forget-password') }}">
                                Forgot password ?
                            </a></span>

                    </div>

                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="loginPageCss/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginPageCss/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginPageCss/vendor/bootstrap/js/popper.js"></script>
    <script src="loginPageCss/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginPageCss/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="loginPageCss/vendor/daterangepicker/moment.min.js"></script>
    <script src="loginPageCss/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="loginPageCss/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="loginPageCss/js/main.js"></script>



    <!-- jQuery -->
    <script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap Core JS -->
    <script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <!-- Custom JS -->
    <script src="{{ URL::to('assets/js/app.js') }}"></script>

</body>

</html>