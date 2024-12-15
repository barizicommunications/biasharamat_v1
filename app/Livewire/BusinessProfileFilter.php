<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BusinessProfile;

class BusinessProfileFilter extends Component
{
    use WithPagination;

    public $investorType = [];
    public $interests = [];
    public $locations = [];
    public $industry;
    public $sort = 'rating';

    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = BusinessProfile::query();

        // Filter by Investor Type
        if (!empty($this->investorType)) {
            $query->whereIn('seller_role', $this->investorType);
        }

        // Filter by Interests
        if (!empty($this->interests)) {
            $query->whereIn('seller_interest', $this->interests);
        }

        // Filter by Locations
        if (!empty($this->locations)) {
            $query->whereIn('city', $this->locations);
        }

        // Filter by Industry
        if ($this->industry) {
            $query->where('business_industry', $this->industry);
        }

        // Sorting Logic (by created_at for now, replace with actual rating if available)
        if ($this->sort === 'rating') {
            $query->orderBy('created_at', 'desc');
        }

        $businessProfiles = $query->paginate(9);

        return view('livewire.business-profile-filter', [
            'businessProfiles' => $businessProfiles,
        ]);
    }
}
