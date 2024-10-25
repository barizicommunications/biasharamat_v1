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
    // public function show(string $id)
    // {
    //     $sellerProfile = BusinessProfile::where('id',$id)->first();
    //     return view('seller.profile-overview', compact('sellerProfile'));
    // }


    public function show(string $id)
{
    $sellerProfile = BusinessProfile::where('id', $id)->first();

    // Decode JSON fields
    $applicationData = json_decode($sellerProfile->application_data, true);
    $documents = json_decode($sellerProfile->documents, true);

    // Pass them to the view
    return view('seller.profile-overview', compact('sellerProfile', 'applicationData', 'documents'));
}


    public function store(BusinessProfileRegistrationRequest $request)
{
    try {
        // Validate the request data
        $validatedData = $request->validated();

        // $businessPhotosPaths = [];

        // $businessPhoto = $request->file('business_photo');


        // if ($businessPhotos) {
        //     foreach ($businessPhotos as $file) {
        //         // Generate a unique name for the file before saving it
        //         $fileName = time() . '-' . $file->getClientOriginalName();

        //         // Store the file in the storage directory (e.g., storage/app/public/files)
        //         $filePath = $file->storeAs('public/businessPhotos', $fileName);

        //         // Store the file path
        //         $businessPhotosPaths[] = $filePath;
        //     }
        // }




        $businessPhoto = $request->file('business_photo');


        if ($businessPhoto) {
            // Generate a unique name for the file before saving it
            $fileName = time() . '-' . $businessPhoto->getClientOriginalName();

            // Store the file in the specified directory (e.g., storage/app/public/information_memorandums)
            $photofilePath = $businessPhoto->storeAs('public/business_photos', $fileName);
        }




        $informationMemorandum = $request->file('information_memorandum');

        if ($informationMemorandum) {
            // Generate a unique name for the file before saving it
            $fileName = time() . '-' . $informationMemorandum->getClientOriginalName();

            // Store the file in the specified directory (e.g., storage/app/public/information_memorandums)
            $memorandumfilePath = $informationMemorandum->storeAs('public/information_memorandums', $fileName);
        }


        // Handle the financial report file
        $financialReport = $request->file('financial_report');

        if ($financialReport) {
            // Generate a unique name for the file before saving it
            $fileName = time() . '-' . $financialReport->getClientOriginalName();

            // Store the file in the specified directory (e.g., storage/app/public/financial_reports)
            $financialfilePath = $financialReport->storeAs('public/financial_reports', $fileName);
        }


        // Handle the valuation worksheet file
        $valuationWorksheet = $request->file('valuation_worksheets');

        if ($valuationWorksheet) {
            // Generate a unique name for the file before saving it
            $fileName = time() . '-' . $valuationWorksheet->getClientOriginalName();

            // Store the file in the specified directory (e.g., storage/app/public/valuation_worksheets)
            $valuationfilePath = $valuationWorksheet->storeAs('public/valuation_worksheets', $fileName);
        }




        // Get the authenticated user
        $user = Auth::user();


        // Create the business profile
        $businessProfile = new BusinessProfile($validatedData);
        $businessProfile->user_id = $user->id;
        $businessProfile->business_photos = $photofilePath;
        $businessProfile->information_memorandum = $memorandumfilePath;
        $businessProfile->financial_report = $financialfilePath;
        $businessProfile->valuation_worksheets = $valuationfilePath;
        $businessProfile->save();


        // Notify the user that their application is under review
        $user->notify(new ApplicationUnderReview($user));


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
