<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends BaseController
{
    public function checkout($id)
    {
        $shop = Shop::findOrFail($id);
        $carts = Cart::where("user_id", Auth::user()->id)->get();
        $shopCarts = $carts->where('product.shop_id', $shop->id);
        return view('frontend.checkout', compact('shop', 'shopCarts'));
    }

    public function store(Request $request, $id)
    {

        $request->validate([
            'contact' => 'required|string|digits:10',
            'address' => 'required|string|max:255',
        ]);

        $shop = Shop::findOrFail($id);
        $carts = Cart::where("user_id", Auth::user()->id)->get();
        $shopCarts = $carts->where('product.shop_id', $shop->id);

        $order = new Order();
        $order->shop_id = $shop->id;
        $order->user_id = Auth::user()->id;
        $order->total_amount = $shopCarts->sum('amount');
        $order->contact = $request->contact;
        $order->status = 'pending';
        $order->delivery_address = $request->address;
        $order->save();

        foreach ($shopCarts as $i => $cart) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cart->product_id;
            $orderItem->amount = $cart->amount;
            $orderItem->qty = $cart->qty;
            $orderItem->save();

            $cart->delete();
        }

        $payment = new Payment();
        $payment->order_id = $order->id;
        $payment->method = $request->payment_method;

        if($request->payment_method == 'qr_payment') {
            $file = $request->payment_receipt_image;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('storage', $filename);
            $payment->payment_receipt = $filename;
        }

        $payment->save();

        toast("Product added to cart", 'success');
        return redirect()->route('home');
    }
}
