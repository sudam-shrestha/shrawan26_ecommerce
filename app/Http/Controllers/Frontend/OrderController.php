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
use Illuminate\Support\Facades\Http;

class OrderController extends BaseController
{

    public function index()
    {
        $orders = Order::where("user_id", Auth::user()->id)->get();
        return view('frontend.orders', compact('orders'));
    }

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

        if ($request->payment_method == 'qr_payment') {
            $file = $request->payment_receipt_image;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('storage', $filename);
            $payment->payment_receipt = $filename;
        }

        $payment->save();

        if ($request->payment_method == 'khalti') {
            $response = Http::withHeaders([
                "Authorization" => "Key " . env("KHALTI_SECRET_KEY")
            ])->post("https://dev.khalti.com/api/v2/epayment/initiate/", [
                "return_url" => route('khalti.callback'),
                "website_url" => env("APP_URL"),
                "amount" => $order->total_amount * 100,
                "purchase_order_id" => $order->id,
                "purchase_order_name" => $order->shop->name,
            ]);

            if ($response["pidx"]) {
                return redirect($response["payment_url"]);
            }
        }

        toast("Product added to cart", 'success');
        return redirect()->route('home');
    }

    public function khalti_callback(Request $request)
    {
        $order = Order::findOrFail($request["purchase_order_id"]);
        $status = $request["status"];
        $payment = $order->payment;
        $payment->status = $status == "Completed" ? "paid" : $status;
        $payment->transaction_id = $request["transaction_id"];
        $payment->save();
        toast($request["status"], 'success');
        return redirect()->route('home');
    }
}
