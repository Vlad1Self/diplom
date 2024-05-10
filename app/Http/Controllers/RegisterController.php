<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request)
    {
      $validated = $request -> validate([
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
         'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
          'password_confirmation' => ['required', 'string', 'min:8', 'max:255'],
          'agreement' => ['accepted'],
      ]);

      $user = new User;
      $user -> name = $validated['name'];
      $user -> email = $validated['email'];
      $user -> password = bcrypt($validated['password']);
      $user -> save();

        return redirect()->route('shop');
    }
}
