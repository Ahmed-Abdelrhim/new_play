<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogPost::create([
            'author_id'=>'1',
            'title' => 'First Blog Post',
            'content' => 'The Content Of The First Blog Post',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

    }
}
