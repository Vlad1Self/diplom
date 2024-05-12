<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('user.posts.index', compact('posts'));
    }
    public function create()
    {
        return view('user.posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['required','mimes:jpeg,png,bmp,gif,svg'],
        ]);

        $post = new Post;
        $post->title = $validated['title'];
        $post->content = $validated['content'];

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
            'avatar' => ['sometimes', 'file', 'mimes:jpeg,jpg,png,gif'],
        ]);

        $post = Post::findOrFail($id);

        $post->title = $validated['title'];
        $post->content = $validated['content'];

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/avatars');
            $post->avatar = basename($path);
        }

        $post->save();

        return redirect()->route('user.posts.show', $post);
    }


    public function delete($post)
    {
        $post->delete();
        return redirect()->route('user.posts', $post);
    }
}
