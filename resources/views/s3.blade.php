@extends('layouts.app')
@section('content')

    <div class="container">
        {{--        <img  src="{{Storage::disk('s3')->response('thumbnails/1666802816.jpg') }}" class="img-fluid" alt="not-found"/>--}}
        <div class="d-flex flex-column">
            <img src="{{$image}}" class="img-thumbnail" style="width: 200px; height: 200px; border-radius: 50%;" alt="not-found"/>
            <h3 class="h3" style="width: 200px; margin-left: 37px;">User Profile</h3>
            <p class="mt-3" style="max-width: 100%;"> {{$image}} </p>
{{--            <p class="mt-3" style="max-width: 100%;"> lorem </p>--}}

        </div>
    </div>

@endsection
