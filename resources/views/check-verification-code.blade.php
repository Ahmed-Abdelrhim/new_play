@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row col-3 mx-auto">
            <form method="post" action="{{route('check.code')}}">
                @csrf
                @if (Session::has('success'))
                    <script>
                        swal({
                            text: " {!! Session::get('success') !!}",
                            icon: "success",
                        })
                    </script>
                @endif

                @if (Session::has('not-found'))
                    <div class="row mr-2 ml-2">
                        <a  class="btn btn-lg btn-block btn-danger mb-2"
                            id="type-error">{{Session::get('not-found')}}
                        </a>
                    </div>
                @endif

                <div class="form-group">
                    <label for="exampleInputEmail1">Code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror"
                           id="exampleInputEmail1" aria-describedby="emailHelp" name="code" value="{{old('code')}}">

                    @error('code')
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
