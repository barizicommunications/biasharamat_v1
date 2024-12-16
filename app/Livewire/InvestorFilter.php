<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InvestorProfile;
use Illuminate\Support\Facades\Log;

class InvestorFilter extends Component
{
    use WithPagination;

    // Filter properties
    public $buyerRoles = [];
    public $interests = [];
    public $companyIndustry = '';
    public $buyerInterest = '';
    public $search = '';
    public $sort = 'investment_range';

    protected $queryString = [
        'buyerRoles' => ['except' => []],
        'interests' => ['except' => []],
        'companyIndustry' => ['except' => ''],
        'buyerInterest' => ['except' => ''],
        'search' => ['except' => ''],
        'sort' => ['except' => 'investment_range'],
    ];

    public function updated($propertyName)
    {
        // For debugging purposes:
        Log::info('Property updated: ' . $propertyName);

        // Reset pagination whenever any filter updates
        $this->resetPage();
    }

    public function render()
    {
        $query = InvestorProfile::query();

        // Apply filters
        if (!empty($this->buyerRoles)) {
            $query->whereIn('buyer_role', $this->buyerRoles);
        }

        if (!empty($this->interests)) {
            // If `interested_in` is a JSON column and you're using Laravel >=5.8 & MySQL 5.7+:
            $query->where(function ($q) {
                foreach ($this->interests as $interest) {
                    $q->orWhereJsonContains('interested_in', $interest);
                }
            });

            // If `interested_in` is just a string field containing comma-separated values,
            // use something like:
            // $query->where(function ($q) {
            //     foreach ($this->interests as $interest) {
            //         $q->orWhere('interested_in', 'like', '%' . $interest . '%');
            //     }
            // });
        }

        if ($this->companyIndustry) {
            $query->where('company_industry', $this->companyIndustry);
        }

        if ($this->buyerInterest) {
            $query->where('buyer_interest', $this->buyerInterest);
        }

        // Apply search
        if ($this->search) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('company_name', 'like', $searchTerm)
                  ->orWhere('buyer_interest', 'like', $searchTerm)
                  ->orWhere('current_location', 'like', $searchTerm)
                  ->orWhere('buyer_role', 'like', $searchTerm);
            });
        }

        // Apply sorting (make sure 'investment_range' is a valid column in your table)
        $query->orderBy($this->sort);

        // Get paginated results
        $investorProfiles = $query->paginate(9);

        return view('livewire.investor-filter', [
            'investorProfiles' => $investorProfiles,
        ]);
    }

    // Helper method to get available industries
    public function getIndustries()
    {
        return ['Education', 'Technology', 'Healthcare', 'Finance', 'Retail'];
    }

    // Helper method to get buyer roles
    public function getBuyerRoles()
    {
        return ['Individual investor/buyer', 'Corporate investor/buyer'];
    }

    // Helper method to get interest options
    public function getInterestOptions()
    {
        return ['Acquiring / Buying a Business', 'Investing in a Business', 'Buying assets'];
    }
}
