<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    public function home()
    {
        $products = Product::all();
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
        if(!$product){
            return view('frontend.404');
        }
        return view('frontend.product', compact('product'));
    }


    public function fallback()
    {
        return view('frontend.404');
    }
}
