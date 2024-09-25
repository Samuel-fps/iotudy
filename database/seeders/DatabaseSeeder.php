<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Eliminate img directories
        Storage::deleteDirectory('articles');
        Storage::deleteDirectory('categories');

        // Create directories
        Storage::makeDirectory('articles');
        Storage::makeDirectory('categories');

        $this->call(UserSeeder::class);

        Category::factory(5)->create();
        Article::factory(20)->create();
        Comment::factory(30)->create();
    }
}
