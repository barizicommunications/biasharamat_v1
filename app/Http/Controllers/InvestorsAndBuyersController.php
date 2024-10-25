<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessProfile;

class InvestorsAndBuyersController extends Controller
{
  /**
     * Display the investors and buyers page.
     */
    public function index()
    {
        // Fetch approved profiles and decode JSON fields
        $businessProfiles = BusinessProfile::where('status', 'pending')->get()->map(function ($profile) {
            $profile->application_data = json_decode($profile->application_data, true);
            $profile->documents = json_decode($profile->documents, true);
            return $profile;
        });

        return view('seller.investors-and-buyers', compact('businessProfiles'));
    }
}
