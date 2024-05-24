<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);

        if (Auth::attempt($validated)) {
            session(['alert' => __('Добро пожаловать!')]);
            return redirect()->route('shop');
        } else {
            session(['alert' => __('Неверный логин или пароль')]);
            return redirect()->route('login');
        }
    }
}
