<?php

namespace App\Observers;

use App\Mail\ShopCredentialNotification;
use App\Models\Shop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ShopObserver
{
    /**
     * Handle the Shop "created" event.
     */
    public function created(Shop $shop): void
    {
        //
    }

    /**
     * Handle the Shop "updated" event.
     */
    public function updated(Shop $shop): void
    {
        if($shop->isDirty('status') && $shop->status == 'active'){
            $password = rand(11111,99999);
            $shop->password = Hash::make($password);
            $shop->saveQuietly();

            Mail::to($shop->email)->send(new ShopCredentialNotification($shop, $password));
        }
    }

    /**
     * Handle the Shop "deleted" event.
     */
    public function deleted(Shop $shop): void
    {
        //
    }

    /**
     * Handle the Shop "restored" event.
     */
    public function restored(Shop $shop): void
    {
        //
    }

    /**
     * Handle the Shop "force deleted" event.
     */
    public function forceDeleted(Shop $shop): void
    {
        //
    }
}
