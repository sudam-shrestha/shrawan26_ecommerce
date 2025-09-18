<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends BaseController
{

    public function index()
    {
        $carts = Cart::where("user_id", Auth::user()->id)->get();
        return view('frontend.carts', compact('carts'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'qty'  => 'required|integer|max:10|min:1'
        ]);

        $product = Product::findOrFail($id);
        $amount = $product->price - ($product->price * $product->discount_percentage) / 100;

        $cart = new Cart();
        $cart->qty = $request->qty;
        $cart->amount = $amount;
        $cart->product_id = $product->id;
        $cart->user_id = Auth::user()->id;
        $cart->save();
        toast("Product added to cart", 'success');
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|max:10|min:1'
        ]);

        $cart = Cart::where('user_id', Auth::user()->id)->findOrFail($id);
        $product = Product::findOrFail($cart->product_id);
        $amount = $product->price - ($product->price * $product->discount_percentage) / 100;

        $cart->qty = $request->qty;
        $cart->amount = $amount * $request->qty;
        $cart->save();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->findOrFail($id);
        $cart->delete();

        return response()->json(['success' => true]);
    }
}
