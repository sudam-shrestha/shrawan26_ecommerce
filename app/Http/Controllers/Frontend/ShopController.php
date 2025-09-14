<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ShopRequestNotification;
use App\Models\Admin;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ShopController extends BaseController
{
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:shops,email',
            'phone' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $shop = new Shop();
        $shop->name = $request->name;
        $shop->email = $request->email;
        $shop->phone = $request->phone;
        $file = $request->photo;
        if ($file) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move('storage', $fileName);
            $shop->photo = $fileName;
        }

        $shop->save();

        $admin = Admin::first();
        Mail::to($admin->email)->send(new ShopRequestNotification($shop));
        toast("Shop request sent successfully", 'success');
        return redirect()->back();
    }
}
