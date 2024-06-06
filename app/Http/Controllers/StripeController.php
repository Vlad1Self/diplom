<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('index');
    }


    public function checkout(Request $request)
    {

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

        // Получаем способ оплаты
        $payment_method = $request->input('payment_method');

        if ($payment_method === 'cash') {
            // Сохраняем заказ в базе данных
            $order = new Order();
            $order->user_id = Auth::id();
            $order->address = $request->input('address');
            $order->entrance = $request->input('entrance');
            $order->floor = $request->input('floor');
            $order->apartment = $request->input('apartment');
            $order->comment = $request->input('comment');
            $order->total_price = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
            $order->save();

            // Сохраняем товары из корзины в заказе
            foreach ($cart as $post_id => $item) {
                $order_item = new Cart();
                $order_item->order_id = $order->id;
                $order_item->post_id = $post_id;
                $order_item->quantity = $item['quantity'];
                $order_item->price = $item['price'];
                $order_item->save();
            }

            // Перенаправляем пользователя на главную страницу с уведомлением об успехе
            session(['alert' => __('Заказ успешно оформлен! Ожидайте курьера в течение часа.')]);

            return redirect()->route('shop');
        } else {
            // Создаем сессию Stripe Checkout
            \Stripe\Stripe::setApiKey(config('stripe.sk'));
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => route('success') . '?success=1',
                'cancel_url' => route('index'),
            ]);

            // Сохраняем заказ в базе данных
            $order = new Order();
            $order->user_id = Auth::id();
            $order->address = $request->input('address');
            $order->entrance = $request->input('entrance');
            $order->floor = $request->input('floor');
            $order->apartment = $request->input('apartment');
            $order->comment = $request->input('comment');
            $order->total_price = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart));
            $order->save();

            // Сохраняем товары из корзины в заказе
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
    }


    public function success(Request $request)
    {
        if ($request->query('success')) {
            session(['alert' => __('Покупка успешно завершена! Ожидайте курьера в течение часа.')]);

        }
        return redirect()->route('shop');
    }

}
