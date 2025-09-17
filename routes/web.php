<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/dashboard', function () {
    return redirect()->route('home');
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


// Login with google routes
Route::get('/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('google_redirect');

Route::get('/callback', function () {
    $user = Socialite::driver('google')->user();

    $oldUser = User::where('email', $user->email)->first();

    if(!$oldUser){
        $newUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => Hash::make(rand(1000,9999)),
        ]);

        Auth::login($newUser);
        return redirect()->route('home');
    }


    Auth::login($oldUser);
    return redirect()->route('home');
});


Route::fallback([PageController::class,'fallback'])->name("fallback");

require __DIR__.'/auth.php';
