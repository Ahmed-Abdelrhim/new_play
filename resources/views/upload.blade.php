@extends('layouts.app')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-8 p-4">
                <form action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                    {{-- Success Message --}}
                    {{--                    @if (Session::has('success'))--}}
                    {{--                        <div class="row mr-2 ml-2">--}}
                    {{--                            <button type="text" class="btn btn-lg btn-block btn-outline-success mb-2"--}}
                    {{--                                    id="type-error">{{Session::get('success')}}--}}
                    {{--                            </button>--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}

                    {{-- Success Message --}}
                    @if (Session::has('success'))
                        <script>
                            swal({
                                text: " {!! Session::get('success') !!}",
                                icon: "success",
                            })
                        </script>
                    @endif

                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Upload Image</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               name="image">
                        <small id="emailHelp" class="form-text text-muted">Upload Image.</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </div>
@endsection
