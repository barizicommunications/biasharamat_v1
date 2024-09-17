<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessProfile extends Model
{
    use HasFactory;


    protected $guarded = [];

    



    // protected $fillable = [
    //     'user_id',
    //     'name',
    //     'company_name',
    //     'mobile_number',
    //     'email',
    //     'display_company_details',
    //     'seller_role',
    //     'seller_interest',
    //     'business_start_date',
    //     'business_industry',
    //     'country',
    //     'city',
    //     'county',
    //     'number_employees',
    //     'business_legal_entity',
    //     'website_link',
    //     'business_description',
    //     'product_services',
    //     'business_highlights',
    //     'facility_description',
    //     'business_funds',
    //     'number_shareholders',
    //     'monthly_turnover',
    //     'yearly_turnover',
    //     'profit_margin',
    //     'tangible_assets',
    //     'liabilities',
    //     'physical_assets',
    //     'interested_in_quotations',
    //     'business_photos',
    //     'information_memorandum',
    //     'financial_report',
    //     'valuation_worksheets',
    //     'active_business',
    // ];

    protected $casts = [
        // 'display_company_details' => 'boolean',
        // 'interested_in_quotations' => 'boolean',
        // 'active_business' => 'array',
        'business_photos' => 'array',
        'business_legal_entity' => 'array',
        'business_industry' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
