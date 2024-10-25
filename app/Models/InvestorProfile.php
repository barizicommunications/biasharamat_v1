<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestorProfile extends Model
{
    use HasFactory;



    protected $guarded = [];


    // protected $fillable = [
    //     'name',
    //     'email',
    //     'mobile_number',
    //     'interested_in',
    //     'buyer_role',
    //     'buyer_interest',
    //     'buyer_location_interest',
    //     'investment_range',
    //     'current_location',
    //     'company_name',
    //     'linkedin_profile',
    //     'website_link',
    //     'business_factors',
    //     'about_company',
    //     'corporate_profile',
    //     'company_logo',
    //     'proof_of_business',
    //     'terms_of_engagement',
    //     'active_business',
    //     'reason_for_decline'
    // ];


    protected $casts = [

        'business_profile' => 'array',
        'certificate_of_incorporation' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
