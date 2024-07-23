<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BusinessProfileRegistrationRequest;

class BusinessProfileController extends Controller
{
    public function create()
    {
        if (!\Auth::check()) {
            return redirect()->route('login');
        }

        return view('seller.business-profile-registration');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sellerProfile = BusinessProfile::where('id',$id)->first();
        return view('seller.profile-overview', compact('sellerProfile'));
    }


    public function store(BusinessProfileRegistrationRequest $request)
{
    try {
        // Validate the request data
        $validatedData = $request->validated();

        // Get the authenticated user
        $user = Auth::user();


        // Create the business profile
        $businessProfile = new BusinessProfile($validatedData);
        $businessProfile->user_id = $user->id;
        $businessProfile->save();



        return redirect()->route('businessVerificationCallPage');

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Redirect back with input and error messages
        return redirect()->back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        // Handle any other exceptions
        return redirect()->back()->with('error', 'An error occurred while creating the business profile.'.$e->getMessage() )->withInput();
    }
}


}
