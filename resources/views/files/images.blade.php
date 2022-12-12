@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row col-3 mx-auto">
            <form method="POST" action="{{route('multiple.images')}}" enctype="multipart/form-data">
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
                    <label>Multiple Image</label>
                    <input type="file" class="form-control @error('images') is-invalid @enderror"
                            name="images[]" multiple >

                    @error('code')
                    <span class="invalid-feedback mb-2" role="alert" style="display: block">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
