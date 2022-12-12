<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    {{--    <link rel="apple-touch-icon" href="{{asset('assets/admin/images/ico/apple-icon-120.png')}}">--}}
    <link rel="apple-touch-icon" href="{{asset('storage/thumbnails/play-1.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/thumbnails/play-1.png')}}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@1,200;1,300;1,400;1,500;1,700;1,800&display=swap"
        rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
          integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" />

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Cairo' , 'Nunito' , sans-serif;
        }

        .scroller {
            background-color: #0075ff;
            position: fixed;
            top: 0;
            left: 0;
            width: 0;
            height: 5px;
        }
    </style>


    {{--    <link rel="stylesheet" href="{{asset('css/style.css')}}">--}}
    @stack('styles')
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{route('home')}}">
                {{--{{ config('app.name', 'Laravel') }}--}}
                Playing
            </a>
            @if(Auth::guard('author')->check())
                {{--  @if( isset(auth()->guard('author')->user()->image) && count(auth()->guard('author')->user()->image) > 0 )  --}}
                {{--      Storage::disk('s3')->url()      --}}
                @if(auth()->guard('author')->user()->avatar != null)
                    <a href="{{route('home')}}">
                        <img class="img-thumbnail"

                             src="{{ asset('storage/profiles/' . auth()->guard('author')->user()->avatar)}}"
                             style="width: 55px; height: 55px; border-radius: 50%;" alt="loading..."/>
                    </a>
                @else
                    <a href="{{route('home')}}">
                        <img class="img-thumbnail" src="{{asset('storage/profiles/pic-6.webp')}}"
                             style="width: 55px; height: 55px; border-radius: 50%;" alt="not-found"/>
                    </a>
                @endif
            @endif

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest('author')
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else

                        @if(Route::current()->getName() != 'blog_posts' )
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('blog_posts')}}">BlogPost</a>
                            </li>
                        @endif

                        @if(Route::current()->getName() != 'sending-email')
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('sending-email')}}">Mail</a>
                            </li>
                        @endif

                            @if(Route::current()->getName() != 'check.verification.code')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('check.verification.code')}}">Check mail</a>
                                </li>
                            @endif



                        @if(Route::current()->getName() != 'add.blog_post' )
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('add.blog_post')}}">Add</a>
                            </li>
                        @endif

                        @if(Route::current()->getName() != 'livewire' )
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('livewire')}}">livewire</a>
                            </li>
                        @endif

                        @if(Route::current()->getName() != 'upload.form' )
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('upload.form')}}">Upload</a>
                            </li>
                        @endif

                            @if(Route::current()->getName() != 'dataTables' )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('dataTables')}}">dataTables</a>
                                </li>
                            @endif

                        {{-- Route::current()->getName() --}}
                        {{-- Request::route()->getPrefix() --}}

                        @if(Route::current()->getName() != 'pay' )
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('pay')}}">Payment</a>
                            </li>
                        @endif



                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                               aria-expanded="false">
                                {{ Auth::guard('author')->user()->name }}
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    Profile
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>

                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>


<script src="https://code.jquery.com/jquery-3.3.1.js" ></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>

@stack('scripts')
</body>
</html>
{{-- <img src="@if(\App\Models\Images::where('imageable_id',Auth::guard('author')->user()->id)->first())--}}
{{--{{asset('storage/'.\App\Models\Images::where('imageable_id',Auth::guard('author')->user()->id)->first()->src)}}--}}
{{-- @else--}}
{{--{{asset('storage/profiles/1666143280.webp')}}--}}
{{-- @endif--}}
{{-- " class="img-thumbnail" style="width: 55px; height: 55px; border-radius: 50%;"/>--}}
