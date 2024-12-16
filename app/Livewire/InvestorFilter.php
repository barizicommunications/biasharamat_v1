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
    public $companyIndustry = '';
    public $buyerInterest = '';
    public $search = '';
    public $sort = 'company_name';

    // Data arrays (for dropdown options)
    public $industries;
    public $buyerRolesOptions;

    protected $queryString = [
        'buyerRoles' => ['except' => []],
        'companyIndustry' => ['except' => ''],
        'buyerInterest' => ['except' => ''],
        'search' => ['except' => ''],
        'sort' => ['except' => 'company_name'],
    ];

    public function mount()
    {
        $this->industries = [
            'Education',
            'Technology',
            'Healthcare',
            'Finance',
            'Retail'
        ];

        $this->buyerRolesOptions = [
            'Individual investor/buyer',
            'Corporate investor/buyer'
        ];
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedBuyerRoles()
    {
        $this->resetPage();
    }

    public function updatedCompanyIndustry()
    {
        $this->resetPage();
    }

    public function updatedBuyerInterest()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = InvestorProfile::query();

        // Apply filters
        if (!empty($this->buyerRoles)) {
            $query->whereIn('buyer_role', $this->buyerRoles);
        }

        if ($this->companyIndustry) {
            $query->where('company_industry', $this->companyIndustry);
        }

        if ($this->buyerInterest) {
            $query->where('buyer_interest', $this->buyerInterest);
        }

        if ($this->search) {
            $query->where('company_name', 'like', '%' . trim($this->search) . '%');
        }

        // Apply sorting
        $query->orderBy($this->sort);

        // Get paginated results
        $investorProfiles = $query->paginate(9);

        return view('livewire.investor-filter', [
            'investorProfiles' => $investorProfiles,
        ]);
    }
}