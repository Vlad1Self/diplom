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
            'avatar' => ['required', 'image', 'max:2048'],
        ]);

        $post = new Post;
        $post->title = $validated['title'];
        $post->content = $validated['content'];

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('public/avatars');
            $post->avatar = basename($path);
        }

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

    public function update(Request $request, $post)
    {
        $validated = validate($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'avatar' => ['required'],
        ]);

        return redirect()->route('user.posts.show', $post);
    }

    public function delete($post)
    {
        $post->delete();
        return redirect()->route('user.posts', $post);
    }
}
