<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Fiction', 'slug' => 'fiction', 'type' => 'genre'],
            ['name' => 'Mystery / Crime', 'slug' => 'mystery-crime', 'type' => 'genre'],
            ['name' => 'Science Fiction', 'slug' => 'science-fiction', 'type' => 'genre'],
            ['name' => 'Fantasy', 'slug' => 'fantasy', 'type' => 'genre'],
            ['name' => 'Romance', 'slug' => 'romance', 'type' => 'genre'],
            ['name' => 'Horror', 'slug' => 'horror', 'type' => 'genre'],
            ['name' => 'Self-Help', 'slug' => 'self-help', 'type' => 'genre'],
            ['name' => 'Business / Finance', 'slug' => 'business-finance', 'type' => 'genre'],
            ['name' => 'History', 'slug' => 'history', 'type' => 'genre'],
            ['name' => 'Science', 'slug' => 'science', 'type' => 'genre'],
        ];

        foreach ($genres as $genre) {
            Category::create($genre);
        }

        User::factory(10)->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('root2000'),
        ]);
    }
}
