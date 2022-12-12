<?php

namespace App\Http\Controllers;

use App\Events\MailEvent;
use App\Http\Requests\Requests\BlogPostRequest;
use App\Jobs\PlayingTask;
use App\Models\Comment;
use App\Models\Currency;
use App\Models\Images;
use App\Models\PaymentPlatform;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Nette\Utils\Image;


use Yajra\DataTables\Facades\DataTables;

class PlayController extends Controller
{
    public function showPosts($id)
    {
        $post = BlogPost::findOrFail($id);
        $author = Author::findOrFail($id);


//        $image =  Storage::disk('s3')->response('thumbnails/' . '1666802816.jpg');
//        $image =  Storage::disk('s3')->url('thumbnails/' . '1666802816.jpg');
//        $image =  Storage::disk('s3')->temporaryUrl('thumbnails/' . '1666802816.jpg',now()->addMinutes(10));
//        $image =  Storage::disk('s3')->url('thumbnails/' . $post->images()->first()->src);
//        return $post->image != null ? $post->image()->first()->src : 'No Image';
        if ($author->image != null) {
            $name = $author->image()->first()->src;
            $image_time_name = substr($name, strpos($name, 'profiles/') + 9); // 9
            $image = Storage::disk('s3')->url('profiles/' . $image_time_name);
            return view('s3', compact('image'));
        }
        return $post;

//        if ($post->images != null) {
//            return $post->images()->first();
//        }
//        return 'Post Has No Images';
        // return $post->comments()->get();

//        (new Carbon\Carbon() )
//        return Carbon::createFromDate($post->createdt_at)->diffForHumans();
//        $author = Author::findOrFail($id);
        //return $author->post()->get();
//        return $author->with('posts')->first();
    }

    public function play($id)
    {
        PlayingTask::dispatch()->delay(5);
        if (is_numeric($id)) {
            $result = [];
            for ($i = 1 ; $i <= $id ; $i++){
                if ($i % 3 == 0 && $i % 5 == 0) {
                    $result[] .= 'FizzBuzz';
                } else if ($i % 3 == 0) {
                    $result[] .= 'Fizz';
                } else if ($i % 5 == 0) {
                    $result[] .= 'Buzz';
                } else {
                    $result[] .= $i;
                }
            }
            return $result;
        }
        return 'Please enter a number';




//        $user = Author::find($id);
//        if($user->image != null) {
//            $string = $user->image()->first()->src;
//            $image_time_name = substr($string, strpos($string, 'profiles/') + 9); // 9
//            // return $image_time_name;
//            $done= Storage::disk('s3')->delete('profiles' . '/' . $image_time_name);
//            if ($done)
//                return 'success';
//            return 'not found image ';
//        }
//
//
//        $author = BlogPost::find($id);
//        if ($author)
//            //abort(400);
//            if ($author->images != null) {
//                dd('true');
//                return $author->images->first();
//            }
//        return 'Author Has No Image';
    }

    public function showBlogPostForm()
    {
        $this->authorize('posts.create');
        return view('blogpost.create');
    }

    public function addBlogPost(BlogPostRequest $request): \Illuminate\Http\RedirectResponse
    {
        $id = Auth::guard('author')->user()->id;
        $post = BlogPost::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author_id' => $id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


//        MailEvent::dispatch($post);
        $request->session()->flash('success', 'BlogPost Inserted Successfully');
        return redirect()->back();
    }

    public function showAllPosts(): \Illuminate\Contracts\View\Factory|View|Application
    {
        // return BlogPost::mostCommented()->take(6)->get();

        MailEvent::dispatch();
//        $posts = cache('posts',function(){
//            return Cache::get('posts');
//        });
        $posts = Cache::get('posts');
        //$mostCommented = BlogPost::mostCommented();
//        return view('blogpost.posts' ,['posts' => $posts, 'mostCommented' => $mostCommented]);
        return view('blogpost.posts' ,['posts' => $posts]);

//        $posts = BlogPost::with('author:name')->paginate(15);
//
//        $mostCommented = BlogPost::mostCommented();
//        // return view('blogpost.posts', ['posts' => BlogPost::withCount('comments')->get(), 'mostCommented' => BlogPost::mostCommented()]);
//        return view('blogpost.posts', ['posts' => $posts, 'mostCommented' => $mostCommented]);
    }

    public function updateBlogPostForm($id): View|\Illuminate\Contracts\View\Factory|string|Application
    {
        $post = BlogPost::findOrFail($id);
        $author = Auth::guard('author')->user();
        // return 'Post Author ID: ' .$post->author_id . '<br> Currently Authenticated User ID: '.$author->id;

//        if (!Gate::allows('update-blogPost', $post)) {
//            // abort(403);
//            return 'Not Allowed To Edit Or Delete This Post';
//        }


        // $this->authorize('update', $post);

        if (!Gate::allows('update-blog_post', $post))
            return view('errors.403');

        // if(Gate::denies('update-blogPost',$author,$post))
        //    return 'You Not Are Allowed To Edit Or Delete This Post';
        return view('blogpost.update', ['post' => $post]);
        // return view('blogpost.update', compact('post'));
    }

    public function storeBlogPost($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:4',
            'content' => 'required|string|min:8',
        ]);
        $blog_post = BlogPost::find($id);
        if (!$blog_post)
            return 'BlogPost Not Found To Be Updated';
        $blog_post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'updated' => now(),
        ]);
        return redirect()->back()->with(['success' => 'BlogPost Updated Successfully']);
    }

    public function destroy($id)
    {
        $post = BlogPost::find($id);
        if (!$post)
            return 'post not found';
        $this->authorize('delete', $post);
        $done = $post->delete();
        if ($done)
            session()->flash('success', 'Post Deleted Successfully');
        return redirect()->route('upload.form');
        // return 'You Are Allowed To Delete This BlogPost';
        // $post->delete();
        //it will go the model and run the boot function
    }

    public function restoreBlogPosts($id): string
    {
        BlogPost::onlyTrashed()->findOrFail($id)->restore();
        return 'BlogPost And Comments Are Restored Successfully';
    }


    public function activeLastMonthAuthor()
    {
        $authors = Author::mostActive()->take(5)->get();
        return view('blogpost.authors', ['authors' => $authors]);
    }

    public function uploadForm()

    {
        return view('upload');
    }

    public function upload(Request $request): \Illuminate\Http\RedirectResponse
    {
        $image_name = time() . '.' . $request->file('image')->guessExtension();
        $name = $request->file('image')->storeAs('thumbnails', $image_name, 's3');
        // $name = Storage::disk('s3')->put('thumbnails/'.$image_name, $request->file('image') );
        // Storage::disk('s3')->setVisibility($name,'public');

        $blogPost = BlogPost::find(1);

        $done = $blogPost->image()->create([
//            'src' => Storage::disk('s3')->url($name),
            'src' => $image_name,
            'type' => 'BlogPost_Photo'
        ]);
        if ($done)
            session()->flash('success', 'Image Uploaded Successfully');
        return redirect()->back();
        // dd(Storage::url($name));
    }

    public function viewProfilePage(): \Illuminate\Contracts\View\Factory|View|Application
    {
        $user = Auth::guard('author')->user();
        $image = null;
        if ($user->image != null)
            $image = $user->image()->first()->src;

        return view('profile', ['user' => $user, 'image' => $image]);
    }

    public function storeUserProfileData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:authors,email,' . Auth::guard('author')->user()->id,
            'password' => 'nullable|string|min:6',
            'phone' => 'nullable|regex:/(01)[0-9]{9}/|min:10|max:11',
            'image' => 'nullable|mimes:jpg,jpeg,png,gif,webp|max:30000'
        ]);
        if ($validator->fails())
            return redirect('user/profile')->withErrors($validator)->withInput();
        $user = Auth::guard('author')->user();
        if ($request->hasFile('image')) {
            $image_name = Str::random(4) .time() . '.' . $request->file('image')->guessExtension();
            $path = $request->file('image')->storeAs('profiles', $image_name, 'public');
            $user->avatar = $image_name;
            $user->save();
            // if (count($user->image) > 0) {
//            if ($user->image != null) {
//                $string = $user->image()->first()->src;
//                $image_time_name = substr($string, strpos($string, 'profiles/') + 9); // 9
//                // return $image_time_name;
//                Storage::disk('s3')->delete('profiles' . '/' . $image_time_name);
//                $user->image()->update([
//                    // 'src' => Storage::disk('s3')->url($path)
//                    'src' => $image_name
//                ]);
//            } else {
//                $user->image()->create([
//                    'src' => $image_name,
//                    'type' => 'avatar',
//                ]);
//            }
        }

        $user->update($request->except(['image', 'password', 'locale']));
        $user->locale = $request->get('locale');
        $user->save();
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
            $user->save();
        }
        $request->session()->flash('success', 'Profile Updated Successfully');
        return view('profile', compact('user'));
    }

    public function js(): View
    {
        return view('play_js');
    }

    public function errorPage(): View
    {
        return view('error');
    }

//    public function show()
//    {
//        return Storage::disk('s3')->response('images/' . $image->filename);
//    }




}
