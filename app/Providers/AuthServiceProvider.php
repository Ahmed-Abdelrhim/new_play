<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\BlogPost;
use App\Models\Author;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
//        'App\Http\Controllers\PlayController' => 'App\Policies\BlogPostPolicy',
        'App\Models\BlogPost' => 'App\Policies\BlogPostPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

//        Gate::define('update-blogPost',function ($author , $post) {
//            return true;
//            return $author->id === $post->author_id;
//                return true;
//            return false;
//        });

//        Gate::define('update-blogPost', function ($user ,  $post) {
//            return $user->id === $post->author_id;
//        });
//
//        Gate::define('delete-blogPost',function($user,$post) {
//            if($user->id === $post->author_id)
//                return true;
//            return false;
//        });
//
        Gate::define('update-blog_post',function ($user,$blog_post){
            if ($user->id == $blog_post->author_id)
                return true;
            return false;
        });

        Gate::before(function($user,$ability) {
            if($user->is_authorized === 1 && in_array($ability , ['update']))
                return true;
        });

        Gate::define('play',function($user,$id) {
            dd($user);
            // return $user->id == $id;
        });

        Gate::define('delete',function($user,$blogpost){
            if($user->id == $blogpost->author_id || $user->name == 'Ahmed Abdelrhim')
                return true;
            return false;
        });

        Gate::define('play',function($user) {
            if($user->name === 'Ahmed Abdelrhim')
                return true;
            return false;
        });


        Gate::resource('posts','App\Policies\BlogPostPolicy');
    }
}
