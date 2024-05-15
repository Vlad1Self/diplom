<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Lenius\Basket\Item;
use Lenius\LaravelEcommerce\Facades\Cart;

class PostController extends Controller
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
        $post->content = strip_tags($validated['content']);
        $post->price = $validated['price'];
        $post->category_id = $validated['category_id'][0];


        $image_path = Storage::disk('public')->put('posts/images', $request->image);
        $post->image_path = $image_path;

        $post->save();

        return redirect()->route('shop');
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('user.posts.show', compact('post'));
    }


    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('user.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'file', 'mimes:jpeg,jpg,png,gif'],
            'price' => ['nullable', 'numeric'],
            'category_id' => ['nullable', 'array', 'exists:categories,id'],
        ]);

        $post->title = $validated['title'];
        $post->content = strip_tags($validated['content']);
        $post->price = $validated['price'];
        $post->category_id = Category::query()->value('id');

        if ($request->hasFile('image')) {
            $image_path = Storage::disk('public')->put('posts/images', $request->image);
            $post->image_path = $image_path;
        }

        $post->save();

        return redirect()->route('shop');
    }

    public function delete(Request $request, $id)
    {
        $post = Post::query()->findOrFail($id);
        Storage::delete($post->image_path);
        $post->delete();
        return redirect()->route('user.posts', $post);
    }
}
