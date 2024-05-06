<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $search = $request -> input ('search');
        $category_id = $request -> input ('category_id');


        $post = (object)[
            'id' => 123,
            'title' => 'Lorem ipsum dolor sit amet.',
            'content' => 'Lorem ipsum <strong> dolor </strong> sit amet, consectetur adipisicing elit. Nemo, qui.',
            'category_id' => '1',
        ];

       $posts = array_fill(0, 10, $post);

       $posts = array_filter($posts, function ($post) use ($search, $category_id) {
           if ($search && ! str_contains(strtolower($post -> title), strtolower($search))) {
               return false;
           }

           if ($category_id && $post -> category_id != $category_id) {
               return false;
           }

           return true;
       });

       $categories=[null => __('Все категории'), 1 => __('Категория 1'), 2 => __('Категория 2')];

        return view('shop.index', compact ('posts', 'categories'));
    }

    public function show($post)
    {

        $post = (object)[
            'id' => 123,
            'title' => 'Lorem ipsum dolor sit amet',
            'content' => 'Lorem ipsum <strong> dolor </strong> sit amet, consectetur adipisicing elit. Nemo, qui',
        ];


        return view('shop.show', compact('post'));
    }
}
