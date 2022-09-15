@extends('layouts.app')

@section('links')
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endsection

@section('content')

<body class="antialiased">
    {{-- message --}}
    {!! Toastr::message() !!}
    <div class="h-screen flex">
        <div class="hidden md-visible lg:flex w-full lg:w-1/2 bg-[#31b13a] center center
          justify-around items-center">
            <div class="bg-black opacity-20 inset-0 z-0"></div>
            <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
                <h1 class="text-white font-bold text-6xl font-sans leading-normal">बिहार ग्राम स्वराज योजना सोसाइटी</h1>
                <p class="text-white mt-1">Log in to continue to your BGSYS HRMS account</p>
                <img src="images/panchaytLoginImage.png" class="w-9/12 my-auto" />

            </div>
        </div>
        <div class="flex w-full lg:w-1/2 justify-center items-center bg-white space-y-8">
            <div class="w-full px-8 md:px-32 lg:px-24">
                <form method="POST" action="{{ route('login') }}" class="bg-white rounded-md shadow-2xl p-5 bg-center">
                    @csrf
                    <center><img src="images/logo.png" class="max-w-[50%]" /></center>
                    <h1 class="text-gray-800 font-bold text-2xl mb-1">Login</h1>
                    <div class="flex items-center border-2 mb-8 py-2 px-3 rounded-2xl">
                        <img src="images/userLogo.png" class="h-5 w-5 text-gray-400" />
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="flex items-center border-2 mb-12 py-2 px-3 rounded-2xl ">
                        <img src="images/passwordLogo.png" class="h-5 w-5 text-gray-400" />
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" placeholder="Enter Password" />
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="block w-full bg-indigo-600 mt-5 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1 transition-all duration-500 text-white font-semibold mb-2">Login</button>
                    <div class="flex justify-between mt-4">
                        <span class="text-sm ml-2 hover:text-blue-500 cursor-pointer hover:-translate-y-1 duration-500 transition-all"><a class="text-muted" href="{{ route('forget-password') }}">
                                Forgot password ?
                            </a></span>

                        <a href="{{ route('register') }}" class="text-sm ml-2 hover:text-blue-500 cursor-pointer hover:-translate-y-1 duration-500 transition-all">Don't have an account yet?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection