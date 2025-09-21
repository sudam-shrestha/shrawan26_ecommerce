<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends BaseController
{
    public function home(Request $request)
    {
        if($request->sort){
            if($request->sort == "latest"){
                $products = Product::orderBy('id', 'desc')->get();
            }else{
                $products = Product::orderBy('price', $request->sort)->get();
            }
        }else{
            $products = Product::all();
        }
        return view('frontend.home', compact('products'));
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $products = Product::where('name', 'like', "%$q%")->get();
        return view('frontend.search', compact('products', 'q'));
    }

    public function product($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return view('frontend.404');
        }
        return view('frontend.product', compact('product'));
    }


    public function fallback()
    {
        return view('frontend.404');
    }


    public function receipt($id)
    {
        $order = Order::findOrFail($id);
        $shop = Auth::guard('shop')->user();
        $user = $order->user;
        if ($shop || $user == Auth::guard('web')->user()) {
            return view('frontend.receipt', compact('order'));
        }

        return view('frontend.404');
    }
}
