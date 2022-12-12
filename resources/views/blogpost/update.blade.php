@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update BlogPots</div>
                    <div class="card-body">
                        <form action="{{route('only.update',$post->id)}}" method="POST">
                            {{-- Success Message --}}
                            @if (Session::has('success'))
                                <div class="row mr-2 ml-2">
                                    <a  class="btn btn-lg btn-block btn-outline-success mb-2"
                                            id="type-error">{{Session::get('success')}}
                                    </a>
                                </div>
                            @endif
                            <!-- asd -->

                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                value="{{$post->title}}" name="title">
                            </div>

                                <div class="form-group" style="margin-top: 15px;">
                                    <label for="exampleInputEmail1">Content</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                           value="{{$post->content}}" name="content">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mx-auto col-8 mt-5 mb-3">Update</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
