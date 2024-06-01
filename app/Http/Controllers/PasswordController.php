<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{

    public function showChangePasswordForm()
    {
        return view('password-change');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Неверный текущий пароль'])->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        session(['alert' => __('Пароль успешно обновлен!')]);
        return redirect()->route('shop');
    }



}
