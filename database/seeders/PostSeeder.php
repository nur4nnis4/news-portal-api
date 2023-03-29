<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PostSeeder extends Seeder
{

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Post::truncate();
        Schema::enableForeignKeyConstraints();
        $titles = ['Welcome', 'Announcement'];
        foreach ($titles as $title) {
            Post::insert([
                'title' => $title,
                'content' => fake()->paragraphs(5, true),
                'author' => fake()->randomElement(User::pluck('id')),
                'created_at' => Carbon::now(),
            ]);
        }
    }
}
