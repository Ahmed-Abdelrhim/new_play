<?php

namespace Database\Seeders;

use Database\Factories\CodesFactory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Comment;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        User::create([
//            'name' => 'Ahmed Abdelrhim',
//            'email' => 'aabdelrhim974@gmail.com',
//            'password' => bcrypt('12345678'),
//            'created_at'=>now(),
//            'updated_at'=>now(),
//        ]);
        // Comment::factory()->count(1)->create();

        \App\Models\VerificationCode::factory()->count(100)->create();
    }
}
