<div>
{{--    style="color: white" --}}
    <h3 class="h3" >View BlogPosts Is Here</h3>

    <table class="table table-dark ">
        <thead>
        <tr>
            <th scope="col">Number</th>
            <th scope="col">Title</th>
            <th scope="col">Content</th>
        </tr>
        </thead>
        <tbody>
        @foreach($blogPosts as $key => $post)
            <tr class="">
                <th scope="row">{{++$key }}</th>
                <th scope="row">{{$post->title}}</th>
                <th scope="row">{{$post->content}}</th>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$blogPosts->links()}}

    {{--        <h3>{{$counter}}</h3>--}}
    {{--        <button wire:click="add" class="btn btn-primary">plus</button>--}}
</div>
