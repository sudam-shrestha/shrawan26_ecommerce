<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get("/",[PageController::class,'home'])->name("home");
Route::post("/shop/store",[ShopController::class,'store'])->name("shop.store");

Route::get("/search",[PageController::class,'search'])->name("search");
Route::get("/product/{id}",[PageController::class,'product'])->name("product");

Route::fallback([PageController::class,'fallback'])->name("fallback");

require __DIR__.'/auth.php';
