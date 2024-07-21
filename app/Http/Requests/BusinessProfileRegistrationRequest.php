<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BusinessProfileRegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'company_name' => 'required',
            'mobile_number' => 'required',
            'email' => 'required|email',
            'display_company_details' => 'sometimes|accepted',
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
            'interested_in_quotations' => 'sometimes|accepted',
            'business_photos' => 'required',
            'business_documents' => 'required',
            'proof_of_business' => 'required',
            'active_business' => 'sometimes|accepted',
        ];
    }
}
