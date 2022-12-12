<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Author::create([
            'name' => 'Ahmed Abdelrhim',
            'email' => 'aabdelrhim974@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '+20 01152067271',
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);
    }
}
