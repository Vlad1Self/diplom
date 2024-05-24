<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $books = Post::all();
        return view('products', compact('books'));
    }

    public function bookCart()
    {
        $books = Post::all();
        return view('card', compact('books'));
    }
    public function addBooktoCart($id)
    {
        $book = Post::findOrFail($id);
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "title" => $book->title,
                "content" => $book->content,
                "quantity" => 1,
                "price" => $book->price,
                "image_path" => $book->image_path,
                "post_id" => $book->id,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back();
    }




    public function updateCart(Request $request)
    {
        if($request->isMethod('patch') && $request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
        }
    }


    public function deleteProduct(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
        }
    }
}
