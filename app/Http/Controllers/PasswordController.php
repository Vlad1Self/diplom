<?php

namespace App\Http\Controllers;

use App\Models\ResetPasswordRequest;
use App\Models\User;
use App\Notifications\PasswordNotification;
use App\Notifications\ResetPasswordNotification;
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


    public function showPasswordResetForm()
    {
        return view('password-request');
    }

    public function sendPasswordResetEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::query()->where('email', $request->email)->first();

        if ($user) {
            $reset_password_request = new ResetPasswordRequest();

            $reset_password_request->token = uuid_create();
            $reset_password_request->email = $request->email;
            $reset_password_request->user_id = $user->id;

            $reset_password_request->save();

            $notification = new ResetPasswordNotification($reset_password_request);

            $user?->notify($notification);

        }

        session(['alert' => __('Запрос на сброс пароля отправлен на ваш адрес электронной почты')]);
        return redirect()->back();
    }


    public function showPasswordResetFormReset(string $token)
    {
        return view('password-request-reset', ['token' => $token]);
    }


    public function sendPasswordResetEmailReset(Request $request, string $token)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        $reset_password_request = ResetPasswordRequest::query()
            ->where('token', $token)
            ->first();

        if (!$reset_password_request) {
            session(['alert' => __('Неверная ссылка для сброса пароля.')]);
            return redirect()->back();
        }

        $user_email = $reset_password_request->email;

        if ($reset_password_request->status === 'completed') {
            session(['alert' => __('Ваш пароль уже был изменен.')]);
            return redirect()->back();
        }

        /** @var User $user */
        $user = User::query()->where('email', $user_email)->first();

        if (Hash::check($request->new_password, $user->password)) {
            session(['alert' => __('Новый пароль не может совпадать с текущим')]);
            return redirect()->back();
        }

        $user->password = bcrypt($request->new_password);

        $reset_password_request->status = 'completed';
        $reset_password_request->save();

        $user->save();

        Auth::login($user);

        session(['alert' => __('Ваш пароль успешно изменен.')]);
        return redirect()->route('shop');
    }

}
