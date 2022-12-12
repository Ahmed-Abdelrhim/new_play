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

            <form method="GET" action="{{route('create.blogPost')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">BlogPost Title</label>
                    <input type="text" class="form-control mt-2" id="exampleInputEmail1"
                           aria-describedby="emailHelp" name="title" value="{{old('title')}}">
                </div>
                @error('title')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <div class="form-group">
                    <label for="exampleInputPassword1" class=" mt-3">BlogPost Content</label>
                    <input type="text" class="form-control " id="exampleInputPassword1" name="content" value="{{old('content')}}">
                </div>
                @error('content')
                <span class="text-danger">{{$message}} </span>
                @enderror
                <div class="col-12 text-center mt-3">
                    <button type="submit" class="btn btn-primary mx-auto col-8">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
