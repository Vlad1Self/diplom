<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class PostController extends Controller
{
    public function index()
    {
        $post = (object)[
            'id' => 123,
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => 'Lorem ipsum <strong> dolor </strong> sit amet, consectetur adipisicing elit. Nemo, qui.',
        ];

        $posts = array_fill(0, 10, $post);

        return view('user.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('user.posts.create');
    }

    public function store(Request $request)
    {

        $validated = validate($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);



        return redirect()->route('user.posts.show', 123);
    }

    public function show($post)
    {

        $post = (object)[
            'id' => 123,
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => 'Lorem ipsum <strong> dolor </strong> sit amet, consectetur adipisicing elit. Nemo, qui.',
        ];

        return view('user.posts.show', compact('post'));
    }

    public function edit($post)
    {
        $post = (object)[
            'id' => 123,
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => 'Lorem ipsum <strong> dolor </strong> sit amet, consectetur adipisicing elit. Nemo, qui.',
        ];

        return view('user.posts.edit', compact('post'));
    }

    public function update(Request $request, $post)
    {
        $validated = validate($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ]);


        return redirect()->route('user.posts.show', $post);
    }

    public function delete($post)
    {
        $post->delete();
        return redirect()->route('user.posts', $post);
    }
}
