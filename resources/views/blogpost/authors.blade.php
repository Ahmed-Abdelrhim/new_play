@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-6 mx-auto">
            {{-- Success Message --}}
            @if (Session::has('success'))
                <div class="row mr-2 ml-2">
                    <a  class="btn btn-lg btn-block btn-outline-success mb-2"
                        id="type-error">{{Session::get('success')}}
                    </a>
                </div>
            @endif
            <div class="row">
                @foreach($authors as $author)
                    <div class="card" style="width: 18rem;">
                        {{--<img src="" class="card-img-top" alt="...">--}}
                        <div class="card-body">
                            <h5 class="card-title">{{$author->name}}</h5>
                            <p class="card-subtitle text-muted">{{$author->email}} : {{$author->phone}}</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection
