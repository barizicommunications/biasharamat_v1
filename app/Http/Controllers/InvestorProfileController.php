<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\InvestorProfile;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BusinessSellerSignup;
use App\Notifications\ApplicationUnderReview;
use App\Http\Requests\InvestorProfileRegistrationRequest;

class InvestorProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!\Auth::check()) {
            return redirect()->route('login');
        }

        return view('buyer.investor-profile-registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvestorProfileRegistrationRequest $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validated();


            $proofOfBusiness = $request->file('proof_of_business');


            if ($proofOfBusiness) {
                // Generate a unique name for the file before saving it
                $fileName = time() . '-' . $proofOfBusiness->getClientOriginalName();

                // Store the file in the specified directory (e.g., storage/app/public/information_memorandums)
                $proofbusinessfilePath = $proofOfBusiness->storeAs('public/proof_of_business', $fileName);
            }




            $companyLogo = $request->file('company_logo');


            if ($companyLogo) {
                // Generate a unique name for the file before saving it
                $fileName = time() . '-' . $companyLogo->getClientOriginalName();

                // Store the file in the specified directory (e.g., storage/app/public/information_memorandums)
                $companylogofilePath = $companyLogo->storeAs('public/investor_company_logos', $fileName);
            }


            $corporateProfile = $request->file('corporate_profile');


            if ($corporateProfile) {
                // Generate a unique name for the file before saving it
                $fileName = time() . '-' . $corporateProfile->getClientOriginalName();

                // Store the file in the specified directory (e.g., storage/app/public/information_memorandums)
                $corporateprofilefilePath = $corporateProfile->storeAs('public/investor_corporate_profiles', $fileName);
            }



            // Get the authenticated user
            $user = Auth::user();


            // Create the business profile
            $investorProfile = new InvestorProfile($validatedData);
            $investorProfile->user_id = $user->id;
            $investorProfile->proof_of_business = $proofbusinessfilePath;
            $investorProfile->company_logo = $companylogofilePath;
            $investorProfile->corporate_profile = $corporateprofilefilePath;
            $investorProfile->save();


            // Notify the user that their application is under review
            // $user->notify(new ApplicationUnderReview());


            // Notify the admin about the new signup
            $admin = User::where('registration_type', 'Admin')->first();
            // $admin->notify(new BusinessSellerSignup($user));



            return redirect()->route('investorVerificationCallPage');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Redirect back with input and error messages
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions
            return redirect()->back()->with('error', 'An error occurred while creating the business profile.'.$e->getMessage() )->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buyerProfile = InvestorProfile::where('id',$id)->first();
        return view('buyer.buyer-profile', compact('buyerProfile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
