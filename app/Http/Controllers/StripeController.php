<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function index()
    {
        return view('index');
    }

   /* public function store(Request $request)
    {
        // Валидация данных из формы
        $request->validate([
            'address' => 'required|string|max:255',
            'entrance' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'comment' => 'nullable|string',
        ]);

        $post_id = $request->input('post_id');

        // Получаем товары из корзины
        $cart = session()->get('cart', []);

        // Создаем новый заказ
        $order = new Order();
        $order->user_id = Auth::id();
        $order->post_id = $cart[$post_id]['post_id'];
        $order->address = $request->input('address');
        $order->entrance = $request->input('entrance');
        $order->floor = $request->input('floor');
        $order->apartment = $request->input('apartment');
        $order->comment = $request->input('comment');
        $order->total_price = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));

        $order->save();

        // Очищаем корзину
        session()->forget('cart');

        // Перенаправляем пользователя на страницу с информацией о заказе
        return redirect()->route('shop', $order->id);
    }*/

    public function checkout( Request $request )
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

        // Сохраняем заказ в базе данных
        $post_id = $request->input('post_id');

        $cart = session()->get('cart', []);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->address = $request->input('address');
        $order->entrance = $request->input('entrance');
        $order->floor = $request->input('floor');
        $order->apartment = $request->input('apartment');
        $order->comment = $request->input('comment');
        $order->total_price = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
        $order->save();

        foreach ($cart as $post_id => $item) {
            $order_item = new Cart();
            $order_item->order_id = $order->id;
            $order_item->post_id = $post_id;
            $order_item->quantity = $item['quantity'];
            $order_item->price = $item['price'];
            $order_item->save();
        }
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
