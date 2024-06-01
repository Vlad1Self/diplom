<?php

namespace App\Http\Controllers;

use App\Notifications\PasswordNotification;
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

        if ($request->new_password === $request->current_password) {
            return redirect()->back()->withErrors(['new_password' => 'Новый пароль не должен совпадать с текущим'])->withInput();
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        session(['alert' => __('Пароль успешно обновлен!')]);
        return redirect()->route('shop');
    }

    public function PasswordReset()
    {
        return view('password-reset');
    }

    public function PasswordResetUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
        ]);

        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            // Password is correct, send notification
            $user->notify(new PasswordNotification());

            session(['alert' => __('Письмо для подтверждения отправлено на вашу почту!')]);
            return redirect()->back();

        } else {
            // Password is incorrect, redirect back with error
            session(['alert' => __('Текущий пароль неверен!')]);
            return redirect()->back();
        }
    }

}
