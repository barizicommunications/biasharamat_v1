<?php

namespace App\Observers;

use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BusinessSellerSignup;
use App\Notifications\ApplicationUnderReview;

class BusinessProfileObserver
{
    /**
     * Handle the BusinessProfile "created" event.
     */
    public function created(BusinessProfile $businessProfile): void
    {
        //    // Get the authenticated user
        //    $user = Auth::user();

        //    // Notify the user
        //    $user->notify(new ApplicationUnderReview($user));

        //    // Fetch the admin user
        //    $admin = User::where('registration_type', 'Admin')->first();

        //    // Notify the admin if found
        //    if ($admin) {
        //        $admin->notify(new BusinessSellerSignup($user));
        //    }
    }

    /**
     * Handle the BusinessProfile "updated" event.
     */
    public function updated(BusinessProfile $businessProfile): void
    {
        //
    }

    /**
     * Handle the BusinessProfile "deleted" event.
     */
    public function deleted(BusinessProfile $businessProfile): void
    {
        //
    }

    /**
     * Handle the BusinessProfile "restored" event.
     */
    public function restored(BusinessProfile $businessProfile): void
    {
        //
    }

    /**
     * Handle the BusinessProfile "force deleted" event.
     */
    public function forceDeleted(BusinessProfile $businessProfile): void
    {
        //
    }
}
