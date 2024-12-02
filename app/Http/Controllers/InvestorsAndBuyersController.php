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
        // Fetch approved profiles with pagination
        $businessProfiles = BusinessProfile::where('status', 'pending')
            ->paginate(12);

        // Decode JSON fields for each profile
        $businessProfiles->getCollection()->transform(function ($profile) {
            $profile->documents = is_string($profile->documents) ? json_decode($profile->documents, true) : $profile->documents;
            $profile->application_data = is_string($profile->application_data) ? json_decode($profile->application_data, true) : $profile->application_data;
            return $profile;
        });

        return view('seller.investors-and-buyers', compact('businessProfiles'));
    }


}
