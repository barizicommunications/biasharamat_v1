<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'mobile_number',
        'email',
        'display_company_details',
        'seller_role',
        'seller_interest',
        'business_start_date',
        'business_industry',
        'country',
        'city',
        'county',
        'number_employees',
        'business_legal_entity',
        'website_link',
        'business_description',
        'product_services',
        'business_highlights',
        'facility_description',
        'business_funds',
        'number_shareholders',
        'monthly_turnover',
        'yearly_turnover',
        'profit_margin',
        'tangible_assets',
        'liabilities',
        'physical_assets',
        'interested_in_quotations',
        'business_photos',
        'business_documents',
        'proof_of_business',
        'active_business',
        'reason_for_decline'
    ];

    protected $casts = [
        'display_company_details' => 'boolean',
        'interested_in_quotations' => 'boolean',
        'active_business' => 'boolean',
        'business_photos' => 'array',
        'business_documents' => 'array',
        'proof_of_business' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
