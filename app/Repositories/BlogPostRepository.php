<?php

namespace App\Repositories;

use App\Models\BlogPost;

class BlogPostRepository
{
    public function index()
    {
        return BlogPost::with('author')->get()->map->format();
    }

    public function show($id)
    {
        return BlogPost::query()->with('comments')->where('id',$id)->firstOr(function(){
            return view('errors.404');
        })->format();
    }

    public function update($id , $request)
    {
        $post =  BlogPost::find($id);
        if(!$post)
            return view('errors.404');
        $done = $post->update($request->all());
        if ($done)
        {
            session()->flash('success','updated success');
            return redirect('show/'.$id);
        }
    }
}
