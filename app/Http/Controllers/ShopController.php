<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category_id = $request->input('category_id');

        $posts = Post::query();

        if ($search) {
            $posts->where('title', 'like', "%{$search}%");
        }

        if ($category_id) {
            $posts->where('category_id', $category_id);
        }

        $posts = $posts->get();

        $categories = Category::all();

        return view('shop.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user.posts.create', ['categories' => $categories]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['required', 'file', 'mimes:jpeg,jpg,png,gif'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'array', 'exists:categories,id'],
        ]);

        $post = new Post;
        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->price = $validated['price'];
        $post->category_id = Category::query()->value('id');

        $image_path = Storage::disk('public')->put('posts/images', $request->image);
        $post->image_path = $image_path;

        $post->save();

        return redirect()->route('shop');
    }

    public function show($id)
    {
        // Получите запись из базы данных по ее идентификатору
        $post = Post::findOrFail($id);

        // Передайте запись во view
        return view('user.posts.show', compact('post'));
    }


    public function edit($post)
    {
        $post = Post::findOrFail($post);

        return view('user.posts.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['required', 'file', 'mimes:jpeg,jpg,png,gif'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required', 'array', 'exists:categories,id'],
        ]);

        $post = Post::findOrFail($id);

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->price = $validated['price'];
        $post->category_id = Category::query()->value('id');

        Storage::delete($post->image_path);
        $image_path = Storage::disk('public')->put('books/images', $request->image);
        $post->image_path = $image_path;

        $post->save();

        return redirect()->route('user.posts.show', $post);
    }

    public function delete(Request $request, $id)
    {
        $post = Post::query()->findOrFail($id);
        Storage::delete($post->image_path);
        $post->delete();
        return redirect()->route('user.posts', $post);
    }
}
