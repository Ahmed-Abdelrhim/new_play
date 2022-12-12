@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                            {{-- Success Message --}}
                            @if (Session::has('error'))
                                <script>
                                    swal({
                                        text: " {!! Session::get('error') !!}",
                                        icon: "error",
                                    })
                                </script>
                            @endif

                        @guest('author')
                            <div>Not Authenticated In Author Guard</div>
                        @else
                            <div>{{Auth::guard('author')->user()->name}}</div>
                        @endguest
                        {{--                            <div>Checking Here {{Auth::guard('author')->check()}}</div>--}}
                        {{ __('You are logged in!') }}
                        {{-- <div>--}}
                        {{-- <video src="{{asset('storage/third/1665768905.mp4')}}" type="mp4" controlsList="nodownload" controls >--}}
                        {{-- </video>--}}
                        {{-- </div>--}}

                    </div>
                </div>
                {{-- My Card--}}
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">{{__('msg.welcome', ['name' => Auth::guard('author')->user()->name]) }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
