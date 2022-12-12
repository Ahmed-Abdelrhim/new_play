@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Posts</div>
                    <div class="row">
                        <div class="col-7">
                            @foreach($posts as $post)
                                <div class="card-body ">
                                    <h5 class="card-title">
                                        <a style="color: grey; text-decoration: none;" href="{{route('show.blog_post.by.id',$post->id)}}">{{$post->title}}</a>
                                    </h5>
                                    <p class="card-text">{{$post->content}}</p>
                                    {{--                                    @if($post->comments_count == 0)--}}
                                    {{--                                        <small id="emailHelp" class="form-text text-muted">--}}
                                    {{--                                            No comments yet--}}
                                    {{--                                        </small>--}}
                                    {{--                                    @endif--}}

                                    {{--                                    @if($post->comments_count == 1)--}}
                                    {{--                                        <small id="emailHelp" class="form-text text-muted">--}}
                                    {{--                                            {{$post->comments_count}} comment--}}
                                    {{--                                        </small>--}}
                                    {{--                                    @endif--}}

                                    {{--                                    @if($post->comments_count > 1)--}}
                                    {{--                                        <small id="emailHelp" class="form-text text-muted">--}}
                                    {{--                                            {{$post->comments_count}} comments--}}
                                    {{--                                        </small>--}}
                                    {{--                                    @endif--}}

                                    <p></p>
                                    @can('update',$post)
                                        <a href="{{route('update.post.form',$post->id)}}"
                                           class="btn btn-primary mb-2">Update</a>
                                    @endcan
                                    @can('delete',$post)
                                        <a href="{{route('delete.post',$post->id)}}"
                                           class="btn btn-danger mb-2">Delete</a>
                                    @endcan
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{--            <div class="col-4">--}}
            {{--                <div class="card">--}}
            {{--                    <div class="card-body">--}}
            {{--                        <h5 class="card-title">Most Commented</h5>--}}
            {{--                        <p class="card-subtitle text-muted mb-2">what people are currently talking about.</p>--}}
            {{--                        @foreach($mostCommented as $post)--}}
            {{--                            <li class="list-group-item">--}}
            {{--                                <a style=" color: gray"--}}
            {{--                                   href="{{route('show.blog_post.by.id',$post->id)}}">{{$post->title}}</a>--}}
            {{--                            </li>--}}
            {{--                        @endforeach--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

        </div>
        {{--       {{$posts->links()}}--}}
    </div>
@endsection
