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
        // Fetch pending investor profiles with pagination
        $investorProfiles = InvestorProfile::where('status', 'pending')
            ->paginate(12);

        // Decode JSON fields for each profile
        $investorProfiles->getCollection()->transform(function ($profile) {
            $profile->documents = is_string($profile->documents) ? json_decode($profile->documents, true) : $profile->documents;
            $profile->application_data = is_string($profile->application_data) ? json_decode($profile->application_data, true) : $profile->application_data;
            return $profile;
        });

        return view('buyer.investors', compact('investorProfiles'));
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
                // Store the file in the specified directory
                $proofbusinessfilePath = $proofOfBusiness->storeAs('public/proof_of_business', $fileName);
            }

            $companyLogo = $request->file('company_logo');

            if ($companyLogo) {
                // Generate a unique name for the file before saving it
                $fileName = time() . '-' . $companyLogo->getClientOriginalName();
                // Store the file in the specified directory
                $companylogofilePath = $companyLogo->storeAs('public/investor_company_logos', $fileName);
            }

            $corporateProfile = $request->file('corporate_profile');

            if ($corporateProfile) {
                // Generate a unique name for the file before saving it
                $fileName = time() . '-' . $corporateProfile->getClientOriginalName();
                // Store the file in the specified directory
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
            $user->notify(new ApplicationUnderReview($user));

            // Notify the admin about the new signup
            $admin = User::where('registration_type', 'Admin')->first();
            if ($admin) {
                $admin->notify(new BusinessSellerSignup($user));
            }

            // Redirect to success page instead of payment
            return view('buyer.verification-call-page');

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