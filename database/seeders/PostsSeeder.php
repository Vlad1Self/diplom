<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 40; $i++) {
            $image = file_get_contents(database_path('data/images/' . $i % 4 . '.jpg'));
            $newImagePath = 'posts/images/' . uniqid() . '.jpg';

            Storage::disk('public')->put($newImagePath, $image);

            $post = Post::factory()->create(['image_path' => $newImagePath]);
            $post->save();

            $post->categories()->sync(Category::pluck('id')->random((rand(1, 3))));
        }
    }
}
