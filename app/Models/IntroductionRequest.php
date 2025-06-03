<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntroductionRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'requester_id',
        'target_type',
        'target_id',
        'target_user_id',
        'requester_name',
        'requester_email',
        'requester_phone',
        'requester_company',
        'introduction_purpose',
        'message',
        'budget_range',
        'status',
        'service_fee',
        'payment_status',
        'rejection_reason',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'service_fee' => 'decimal:2',
        'reviewed_at' => 'datetime',
    ];

    /**
     * Get the user who requested the introduction
     */
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    /**
     * Get the target user (business owner or investor)
     */
    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_user_id');
    }

    /**
     * Get the admin who reviewed the request
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Get the business target if target_type is 'business'
     */
    public function businessTarget()
    {
        return $this->belongsTo(BusinessProfile::class, 'target_id')->where('target_type', 'business');
    }

    /**
     * Get the investor target if target_type is 'investor'
     */
    public function investorTarget()
    {
        return $this->belongsTo(InvestorProfile::class, 'target_id')->where('target_type', 'investor');
    }

    /**
     * Get the target profile regardless of type
     */
    public function getTargetAttribute()
    {
        if ($this->target_type === 'business') {
            return $this->businessTarget;
        } elseif ($this->target_type === 'investor') {
            return $this->investorTarget;
        }
        return null;
    }

    /**
     * Get the target name
     */
    public function getTargetNameAttribute()
    {
        $target = $this->target;
        if (!$target) return 'Unknown';

        if ($this->target_type === 'business') {
            return $target->application_data['company_name'] ?? 'Business';
        } elseif ($this->target_type === 'investor') {
            return $target->company_name;
        }
        return 'Unknown';
    }

    /**
     * Get the status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'pending' => 'yellow',
            'approved' => 'green',
            'rejected' => 'red',
            'completed' => 'blue',
            default => 'gray',
        };
    }

    /**
     * Get the formatted purpose
     */
    public function getFormattedPurposeAttribute()
    {
        return match($this->introduction_purpose) {
            'investment_opportunity' => 'Investment Opportunity',
            'business_acquisition' => 'Business Acquisition',
            'partnership' => 'Strategic Partnership',
            'financing' => 'Business Financing',
            'asset_purchase' => 'Asset Purchase',
            'other' => 'Other',
            default => ucfirst(str_replace('_', ' ', $this->introduction_purpose)),
        };
    }

    /**
     * Get the formatted budget range
     */
    public function getFormattedBudgetRangeAttribute()
    {
        if (!$this->budget_range) return 'Not specified';

        return match($this->budget_range) {
            'under_1m' => 'Under KES 1M',
            '1m_5m' => 'KES 1M - 5M',
            '5m_10m' => 'KES 5M - 10M',
            '10m_50m' => 'KES 10M - 50M',
            '50m_100m' => 'KES 50M - 100M',
            'over_100m' => 'Over KES 100M',
            default => 'Not specified',
        };
    }

    /**
     * Scope for pending requests
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for approved requests
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for rejected requests
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope for requests by a specific user
     */
    public function scopeByRequester($query, $userId)
    {
        return $query->where('requester_id', $userId);
    }

    /**
     * Scope for requests targeting a specific user
     */
    public function scopeTargetingUser($query, $userId)
    {
        return $query->where('target_user_id', $userId);
    }
}