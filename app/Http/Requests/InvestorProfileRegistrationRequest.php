<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvestorProfileRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|numeric|digits:10',
            'interested_in' => 'required|string|in:acquiring_business,investing_in_a_business,lending_to_a_business,buying_property_plant_machinery,taking_up_franchise',
            'buyer_role' => 'required|string|in:Individual investor/buyer,Corporate investor/buyer',
            'buyer_interest' => 'required|string|in:Select all,Education,Technology,Building construction and maintenance',
            'buyer_location_interest' => 'required|string|in:Nairobi,Mombasa,Kisumu,Eldoret,Nakuru',
            'investment_range' => 'required|numeric|min:0',
            'current_location' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'linkedin_profile' => 'required|url|max:255',
            'website_link' => 'required|url|max:255',
            'business_factors' => 'required|string|max:1000',
            'about_company' => 'required|string|max:1000',
            'corporate_profile' => 'required|file|mimes:pdf,docx,xlsx,pptx,txt|max:2048',
            'company_logo' => 'required|file|mimes:jpg,jpeg,png|max:2048',
            'proof_of_business' => 'required|file|mimes:pdf,docx,xlsx,pptx,txt|max:2048',
            'terms_of_engagement' => 'accepted',
            'reason_for_decline'=>'nullable',
            'active_business' => 'required|string|in:active business,premium plan,yearly plan',
        ];
    }
}
