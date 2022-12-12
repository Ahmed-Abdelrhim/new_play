@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row col-3 mx-auto">
            <form method="post" action="{{route('check.mobile_no')}}">
                @csrf
                @if(Session::has('otp'))
                    <div class="row mr-2 ml-2">
                        <a  class="btn btn-lg btn-block btn-success mb-2"
                            id="type-error">{{Session::get('otp')}}
                        </a>
                    </div>
                @endif

                @if (Session::has('not-found'))
                    <div class="row mr-2 ml-2">
                        <a  class="btn btn-lg btn-block btn-danger mb-2"
                            id="type-error">{{Session::get('not-found')}}
                        </a>
                    </div>
                @endif

                <div class="form-group">
                    <label for="exampleInputEmail1">Mobile Number</label>
                    <input type="text" class="form-control @error('mobile_no') is-invalid @enderror" required min="11" max="11"
                           id="exampleInputEmail1" aria-describedby="emailHelp" name="mobile_no" value="{{old('mobile_no')}}">

                    @error('mobile_no')
                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <p class="mt-3">Enter the code you have just received in your mail .</p>
        </div>
    </div>
@endsection
