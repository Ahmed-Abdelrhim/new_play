<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use App\Models\Author;
use App\Models\BlogPost;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();


//        $posts = BlogPost::get();
//        Comment::factory()->count(10)->make()->each(function($comment) use($posts) {
//            $comment->post_id = $posts->random()->id;
//            $comment->save();
//        });

        $authors = Author::get();
        BlogPost::factory()->count(50)->make()->each(function($post) use($authors) {
            $post->author_id = $authors->random()->id;
            $post->save();
        });

    }
}
