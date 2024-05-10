<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
       $validated = $request -> validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
        ]);

        session(['alert' => __('Добро пожаловать!')] );

        return redirect()->route('shop');
    }
}
