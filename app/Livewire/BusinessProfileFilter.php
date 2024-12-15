<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class BusinessProfileFilter extends Component
{
    use WithPagination;

    // Filter Properties
    public $country = '';
    public $city = '';
    public $sellerInterest = [];
    public $businessLegalEntity = '';
    public $industry = '';
    public $sort = 'rating';

    // Data Arrays
    public $countries = [];
    public $cities = [];

    // Constants
    const SELLER_INTERESTS = [
        'Sale of shares',
        'Partial sale of shares',
        'Sale of assets',
        'Financing'
    ];

    const LEGAL_ENTITIES = [
        "Sole proprietorship/sole trader",
        "General partnership",
        "Limited liability partnership (LLP)",
        "Private limited company (Ltd)",
        "Public limited company (PLC)",
        "Limited liability company (LLC)",
        "Corporation (Inc)",
        "Non-profit organization (NPO)",
        "Cooperative",
        "Joint venture",
        "Franchise",
        "Trust",
        "Association",
        "Company limited by guarantee",
        "Unlimited company",
        "Other"
    ];


    const INDUSTRIES = [
        "Technology",
        "Building, construction and maintenance",
        "Education",
        "Healthcare",
        "Finance and Insurance",
        "Real Estate",
        "Manufacturing",
        "Retail",
        "Hospitality and Tourism",
        "Transportation and Logistics",
        "Agriculture and Farming",
        "Energy and Utilities",
        "Telecommunications",
        "Media and Entertainment",
        "Legal Services",
        "Government and Public Services",
        "Non-profit Organizations",
        "Consulting and Professional Services",
        "Food and Beverage",
        "Automotive",
        "Other"
    ];

    // Lifecycle Hooks
    public function mount()
    {
        try {
            $countriesData = Storage::disk('local')->get('data/countries.json');
            $this->countries = collect(json_decode($countriesData, true))->keys()->toArray();
        } catch (\Exception $e) {
            Log::error('Failed to load countries:', ['error' => $e->getMessage()]);
            $this->countries = [];
        }
    }

    public function updatedCountry($value)
    {
        $this->reset('city');
        $this->cities = [];

        if ($value) {
            try {
                $data = json_decode(Storage::disk('local')->get('data/countries.json'), true);
                $this->cities = $data[$value] ?? [];
                Log::info('Cities loaded for country:', ['country' => $value, 'count' => count($this->cities)]);
            } catch (\Exception $e) {
                Log::error('Failed to load cities:', ['error' => $e->getMessage()]);
            }
        }

        $this->resetPage();
    }

    public function updated($propertyName)
    {
        // Reset pagination when any filter changes
        $this->resetPage();
    }

    public function render()
    {
        $query = BusinessProfile::query();

        // Apply filters using a more robust approach
        $this->applyFilters($query);

        // Get paginated results
        $businessProfiles = $query->paginate(9);

        return view('livewire.business-profile-filter', [
            'businessProfiles' => $businessProfiles,
            'sellerInterests' => self::SELLER_INTERESTS,
            'legalEntities' => self::LEGAL_ENTITIES,
            'industries' => self::INDUSTRIES,
        ]);
    }

    private function applyFilters($query)
    {
        // Country filter
        if ($this->country) {
            $query->where('application_data->country', $this->country);
        }

        // City filter
        if ($this->city) {
            $query->where('application_data->city', $this->city);
        }

        // Seller Interest filter (multiple selection)
        if (!empty($this->sellerInterest)) {
            $query->where(function ($q) {
                foreach ($this->sellerInterest as $interest) {
                    $q->orWhere('application_data->seller_interest', $interest);
                }
            });
        }

        // Business Legal Entity filter
        if ($this->businessLegalEntity) {
            $query->where('application_data->business_legal_entity', $this->businessLegalEntity);
        }

        // Industry filter
        if ($this->industry) {
            $query->where('application_data->business_industry', $this->industry);
        }

        // Sorting
        switch ($this->sort) {
            case 'rating':
                $query->orderBy('created_at', 'desc');
                break;
            // Add more sorting options as needed
        }

        return $query;
    }
}