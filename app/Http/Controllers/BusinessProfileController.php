<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Business;
use Illuminate\Http\Request;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BusinessSellerSignup;
use App\Notifications\ApplicationUnderReview;
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

        $businessPhotos = $request->file('business_photos');
        $businessDocuments = $request->file('business_documents');
        $proofOfBusiness = $request->file('proof_of_business');

        $photofileName = time() . '.' . $businessPhotos->getClientOriginalExtension();
        $businessPhotos->storeAs('public/business_photos', $photofileName);


        $businessDocumentFile = time() . '.' . $businessDocuments->getClientOriginalExtension();
        $businessDocuments->storeAs('public/business_documents', $businessDocumentFile);


        $proofOfBusinessFile = time() . '.' . $proofOfBusiness->getClientOriginalExtension();
        $proofOfBusiness->storeAs('public/proof_of_business', $proofOfBusinessFile);



        // Get the authenticated user
        $user = Auth::user();


        // Create the business profile
        $businessProfile = new BusinessProfile($validatedData);
        $businessProfile->user_id = $user->id;
        $businessProfile->save();


        // Notify the user that their application is under review
        $user->notify(new ApplicationUnderReview());


        // Notify the admin about the new signup
        $admin = User::where('registration_type', 'Admin')->first();
        $admin->notify(new BusinessSellerSignup($user));



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
