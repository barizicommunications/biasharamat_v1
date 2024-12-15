<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessProfile extends Model
{
    use HasFactory;


    protected $guarded = [];


    protected $casts = [
        'business_photos' => 'array',
        'business_legal_entity' => 'array',
        'business_industry' => 'array',
        'application_data'=>'array',
        'documents'=>'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
