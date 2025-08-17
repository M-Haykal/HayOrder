<?php

namespace App\Observers;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailDashboard;

class RestaurantObserver
{
    /**
     * Handle the Restaurant "created" event.
     */
    public function created(Restaurant $restaurant): void
    {
        //
    }

    /**
     * Handle the Restaurant "updated" event.
     */
    public function updated(Restaurant $restaurant): void
    {
        if ($restaurant->isDirty('status') && $restaurant->status === 'approved') {
            $owner = $restaurant->owner;

            if ($owner && $owner->email) {
                $url = url("/restaurant/{$restaurant->slug}/dashboard");

                Mail::to($owner->email)->send(new SendEmailDashboard($restaurant, $url));
            }
        }
    }

    /**
     * Handle the Restaurant "deleted" event.
     */
    public function deleted(Restaurant $restaurant): void
    {
        //
    }

    /**
     * Handle the Restaurant "restored" event.
     */
    public function restored(Restaurant $restaurant): void
    {
        //
    }

    /**
     * Handle the Restaurant "force deleted" event.
     */
    public function forceDeleted(Restaurant $restaurant): void
    {
        //
    }
}
