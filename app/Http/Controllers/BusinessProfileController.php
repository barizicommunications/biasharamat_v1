<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    // public function store(BusinessProfileRegistrationRequest $request)
    // {
    //     $data = $request->validated();

    //     dd($data);
    // }

    public function store(Request $request)
{
    // Define validation rules
    $rules = [
        'name' => 'required',
        'company_name' => 'required',
        'mobile_number' => 'required',
        'email' => 'required|email',
        'display_company_names' => 'boolean',
        'seller_role' => 'required|in:Director,Adviser,Shareholder,Other',
        'seller_interest' => 'required',
        'business_start_date' => 'required|date',
        'business_industry' => 'required',
        'country' => 'required',
        'city' => 'required',
        'county' => 'required',
        'number_employees' => 'required|numeric',
        'business_legal_entity' => 'required',
        'website_link' => 'required|url',
        'business_description' => 'required',
        'product_services' => 'required',
        'business_highlights' => 'required',
        'facility_description' => 'required',
        'business_funds' => 'required',
        'number_shareholders' => 'required',
        'monthly_turnover' => 'required',
        'yearly_turnover' => 'required',
        'profit_margin' => 'required',
        'tangible_assets' => 'required',
        'liabilities' => 'required',
        'physical_assets' => 'required',
        'interested_in_quotations' => 'required',
        'business_photos' => 'required',
        'business_documents' => 'required',
        'proof_of_business' => 'required',
    ];

    // Validate the request
    $validatedData = $request->validate($rules);

    // If validation passes, proceed with storing the data
    // Example: Store data in the database
    // YourModel::create($validatedData);

    // Return a response, e.g., a redirect or a JSON response
    return response()->json(['message' => 'Data successfully validated and stored.']);
}

}
