<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function checkout()
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        // Получаем товары из корзины
        $cart = session()->get('cart', []);

        // Создаем массив line_items для Stripe Checkout
        $line_items = [];
        foreach ($cart as $id => $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'rub',
                    'product_data' => [
                        'name' => $item['title'],
                    ],
                    'unit_amount' => $item['price'] * 100,
                ],
                'quantity' => $item['quantity'],
            ];
        }

        // Создаем сессию Stripe Checkout
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => route('success') . '?success=1',
            'cancel_url' => route('index'),
        ]);

        // Перенаправляем пользователя на страницу Stripe Checkout
        return redirect()->away($session->url);
    }

    public function success(Request $request)
    {
        if ($request->query('success')) {
            session(['alert' => __('Покупка успешно завершена!')]);

        }
        return redirect()->route('shop');
    }


}
