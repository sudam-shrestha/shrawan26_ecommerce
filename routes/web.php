<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ShopController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/",[PageController::class,'home'])->name("home");
Route::post("/shop/store",[ShopController::class,'store'])->name("shop.store");
