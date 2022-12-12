<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
            'post_id' => 1,
            'content' => 'The Comment Of The First Blog Post',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
