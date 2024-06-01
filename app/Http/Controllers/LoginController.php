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

            return redirect()->route('login')->withErrors(['email' => 'Неверный логин или пароль', 'password' => 'Неверный логин или пароль'])->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
