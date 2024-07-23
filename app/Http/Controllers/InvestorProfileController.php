<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvestorProfile;
use Illuminate\Support\Facades\Auth;
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

            // Get the authenticated user
            $user = Auth::user();


            // Create the business profile
            $investorProfile = new InvestorProfile($validatedData);
            $investorProfile->user_id = $user->id;
            $investorProfile->save();



            return redirect()->route('businessVerificationCallPage');

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
        //
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
