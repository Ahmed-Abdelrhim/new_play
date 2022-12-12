@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row col-5 mx-auto">
            <form method="POST" action="{{route('send.gmail')}}">
                @csrf
                @if (Session::has('success'))
                    <script>
                        swal({
                            text: " {!! Session::get('success') !!}",
                            icon: "success",
                        })
                    </script>
                @endif

                <div class="form-group">
                    <label for="exampleInputEmail1">E-mail</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="exampleInputEmail1" aria-describedby="emailHelp" name="email">

                    @error('email')
                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    {{--                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone--}}
                    {{--                        else.</small>--}}
                </div>


                <div class="form-group">
                    <label for="exampleInputEmail1">Msg</label>
                    <input type="text" class="form-control @error('msg') is-invalid @enderror" id="exampleInputEmail1"
                           aria-describedby="emailHelp" name="msg">
                </div>

                @error('msg')
                <span class="invalid-feedback mb-2" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <p class="mt-3">Thank you for reading this, hope to hear from you soon.</p>
        </div>
    </div>
@endsection
