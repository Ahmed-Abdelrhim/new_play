<!doctype html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <style>
        @import url('https://rsms.me/inter/inter-ui.css');

        ::selection {
            background: #2D2F36;
        }

        ::-webkit-selection {
            background: #2D2F36;
        }

        ::-moz-selection {
            background: #2D2F36;
        }

        body {
            background: white;
            font-family: 'Inter UI', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .page {
            background: #e2e2e5;
            display: flex;
            flex-direction: column;
            height: calc(100% - 40px);
            position: absolute;
            place-content: center;
            width: calc(100% - 40px);
        }

        @media (max-width: 767px) {
            .page {
                height: auto;
                margin-bottom: 20px;
                padding-bottom: 20px;
            }
        }

        .container {
            display: flex;
            height: 320px;
            margin: 0 auto;
            width: 640px;
        }

        @media (max-width: 767px) {
            .container {
                flex-direction: column;
                height: 630px;
                width: 320px;
            }
        }

        .left {
            background: white;
            height: calc(100% - 40px);
            top: 20px;
            position: relative;
            width: 50%;
        }

        @media (max-width: 767px) {
            .left {
                height: 100%;
                left: 20px;
                width: calc(100% - 40px);
                max-height: 270px;
            }
        }

        .login {
            font-size: 50px;
            font-weight: 900;
            margin: 50px 40px 40px;
        }

        .eula {
            color: #999;
            font-size: 14px;
            line-height: 1.5;
            margin: 40px;
        }

        .right {
            background: #474A59;
            box-shadow: 0px 0px 40px 16px rgba(0, 0, 0, 0.22);
            color: #F1F1F2;
            position: relative;
            width: 50%;
        }

        @media (max-width: 767px) {
            .right {
                flex-shrink: 0;
                height: 100%;
                width: 100%;
                max-height: 350px;
            }
        }

        svg {
            position: absolute;
            width: 320px;
        }

        path {
            fill: none;
            stroke: url(#linearGradient);;
            stroke-width: 4;
            stroke-dasharray: 240 1386;
        }

        .form {
            margin: 40px;
            position: absolute;
        }

        label {
            color: #c2c2c5;
            display: block;
            font-size: 14px;
            height: 16px;
            margin-top: 20px;
            margin-bottom: 5px;
        }

        input {
            background: transparent;
            border: 0;
            color: #f2f2f2;
            font-size: 20px;
            height: 30px;
            line-height: 30px;
            outline: none !important;
            width: 100%;
        }

        input::-moz-focus-inner {
            border: 0;
        }

        #submit {
            color: #707075;
            margin-top: 40px;
            transition: color 300ms;
        }

        #submit:focus {
            color: #f2f2f2;
        }

        #submit:active {
            color: #d0d0d2;
        }

    </style>
</head>
<body>
<div class="page">
    <div class="container">
        <div class="left">
            <div class="login">Login</div>
            <div class="eula">By logging in you agree to the ridiculously long terms that you didn't bother to read
            </div>
        </div>
        <div class="right" style="height: 345px;">
            <svg viewBox="0 0 320 300">
                <defs>
                    <linearGradient
                        inkscape:collect="always"
                        id="linearGradient"
                        x1="13"
                        y1="193.49992"
                        x2="307"
                        y2="193.49992"
                        gradientUnits="userSpaceOnUse">
                        <stop
                            style="stop-color:#ff00ff;"
                            offset="0"
                            id="stop876"/>
                        <stop
                            style="stop-color:#ff0000;"
                            offset="1"
                            id="stop878"/>
                    </linearGradient>
                </defs>
                <path
                    d="m 40,120.00016 239.99984,-3.2e-4 c 0,0 24.99263,0.79932 25.00016,35.00016 0.008,34.20084 -25.00016,35 -25.00016,35 h -239.99984 c 0,-0.0205 -25,4.01348 -25,38.5 0,34.48652 25,38.5 25,38.5 h 215 c 0,0 20,-0.99604 20,-25 0,-24.00396 -20,-25 -20,-25 h -190 c 0,0 -20,1.71033 -20,25 0,24.00396 20,25 20,25 h 168.57143"/>
            </svg>
            <form action="{{route('signIn')}}" method="POST">
                @csrf
                @error('errors')
                <div class="row mr-2 ml-2 mb-3 col-7 mx-auto">
                    <a href="#" class="btn btn-danger mb-2"
                       id="type-error">{{$message}}
                    </a>
                    <span class="invalid-feedback mb-2" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
                @enderror
                <div class="form">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" >
                    @error('email')
                    <span class="invalid-feedback mb-2" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">

                    <p style="margin-top: 3px;">Don't have an account !
                        <a href="{{route('register')}}" style="color: grey; ">SignUp Now</a>
                    </p>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    {{-- <input type="submit" id="submit" value="Submit" >--}}
                    <button type="submit" class="btn btn-block btn-dark mt-5">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    var current = null;
    document.querySelector('#email').addEventListener('focus', function (e) {
        if (current) current.pause();
        current = anime({
            targets: 'path',
            strokeDashoffset: {
                value: 0,
                duration: 700,
                easing: 'easeOutQuart'
            },
            strokeDasharray: {
                value: '240 1386',
                duration: 700,
                easing: 'easeOutQuart'
            }
        });
    });
    document.querySelector('#password').addEventListener('focus', function (e) {
        if (current) current.pause();
        current = anime({
            targets: 'path',
            strokeDashoffset: {
                value: -336,
                duration: 700,
                easing: 'easeOutQuart'
            },
            strokeDasharray: {
                value: '240 1386',
                duration: 700,
                easing: 'easeOutQuart'
            }
        });
    });
    document.querySelector('#submit').addEventListener('focus', function (e) {
        if (current) current.pause();
        current = anime({
            targets: 'path',
            strokeDashoffset: {
                value: -730,
                duration: 700,
                easing: 'easeOutQuart'
            },
            strokeDasharray: {
                value: '530 1386',
                duration: 700,
                easing: 'easeOutQuart'
            }
        });
    });
</script>
</body>
</html>


{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <div class="container">--}}
{{--        <div class="row justify-content-center">--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">{{ __('Login') }}</div>--}}
{{--                    <div class="card-body">--}}
{{--                        <form method="POST" action="{{ route('signIn') }}">--}}
{{--                            @csrf--}}
{{--                            @error('errors')--}}
{{--                            <div class="row mr-2 ml-2 mb-3 col-7 mx-auto">--}}
{{--                                <a href="#" class="btn btn-danger mb-2"--}}
{{--                                   id="type-error">{{$message}}--}}
{{--                                </a>--}}

{{--                                --}}{{--<span class="invalid-feedback mb-2" role="alert">--}}
{{--                                --}}{{--<strong>{{ $message }}</strong>--}}
{{--                                --}}{{--</span>--}}
{{--                            </div>--}}
{{--                            @enderror--}}

{{--                            <div class="row mb-3">--}}
{{--                                <label for="email"--}}
{{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="email" type="text"--}}
{{--                                           class="form-control @error('email') is-invalid @enderror" name="email"--}}
{{--                                           value="{{ old('email') }}" required autocomplete="email" autofocus>--}}
{{--                                    @error('email')--}}
{{--                                    <span class="invalid-feedback mb-2" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row mb-3">--}}
{{--                                <label for="password"--}}
{{--                                       class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password" type="password"--}}
{{--                                           class="form-control @error('password') is-invalid @enderror" name="password"--}}
{{--                                           autocomplete="current-password">--}}
{{--                                    <p style="margin-top: 3px;">Don't have an account ! <a href="{{route('register')}}" style="color: grey; ">SignUp Now</a></p>--}}
{{--                                    @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}

{{--                                    --}}{{--@error('password')--}}
{{--                                    --}}{{--<span class="invalid-feedback" role="alert">--}}
{{--                                    --}}{{--<strong>{{ $message }}</strong>--}}
{{--                                    --}}{{--</span>--}}
{{--                                    --}}{{--@enderror--}}
{{--                                </div>--}}


{{--                                <div class="row mb-3 mt-3">--}}
{{--                                    <div class="col-md-6 offset-md-4">--}}
{{--                                        <button  type="submit" class="col-md-6 col-sm-8 btn btn-primary">--}}
{{--                                            Login--}}
{{--                                        </button>--}}

{{--                                        @if (Route::has('password.request'))--}}
{{--                                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                                {{ __('Forgot Your Password?') }}--}}
{{--                                            </a>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            --}}{{--                            <div class="row mb-3">--}}
{{--                            --}}{{--                                <div class="col-md-6 offset-md-4">--}}
{{--                            --}}{{--                                    <div class="form-check">--}}
{{--                            --}}{{--                                        <input class="form-check-input" type="checkbox" name="remember"--}}
{{--                            --}}{{--                                               id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                            --}}{{--                                        <label class="form-check-label" for="remember">--}}
{{--                            --}}{{--                                            {{ __('Remember Me') }}--}}
{{--                            --}}{{--                                        </label>--}}
{{--                            --}}{{--                                    </div>--}}
{{--                            --}}{{--                                </div>--}}
{{--                            --}}{{--                            </div>--}}


{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
