<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BusinessProfile;
use Illuminate\Support\Facades\Storage;

class BusinessProfileFilter extends Component
{
    use WithPagination;

    public $country;
    public $city;
    public $sellerInterest = [];
    public $businessLegalEntity;
    public $industry;
    public $sort = 'rating';

    public $countries = [];
    public $cities = [];

    public function mount()
    {


        // Load the countries from the JSON file during component initialization
        $this->countries = collect(json_decode(Storage::disk('local')->get('data/countries.json'), true))->keys()->toArray();
        
    }

    public function updatedCountry($value)
{
    // Reset city when the country changes
    $this->reset('city');
    $this->cities = [];

    // Load cities based on the selected country
    if ($value) {
        $data = json_decode(Storage::disk('local')->get('data/countries.json'), true);
        $this->cities = $data[$value] ?? [];

        // Debug log to check cities loaded
        \Log::info('Loaded Cities:', ['country' => $value, 'cities' => $this->cities]);
    }

    $this->resetPage();
}


    public function updated($propertyName)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = BusinessProfile::query();

        // Filter by Country
        if ($this->country) {
            $query->where('application_data->country', $this->country);
        }

        // Filter by City
        if ($this->city) {
            $query->where('application_data->city', $this->city);
        }

        // Filter by Seller Interest
        if (!empty($this->sellerInterest)) {
            $query->whereIn('application_data->seller_interest', $this->sellerInterest);
        }

        // Filter by Business Legal Entity
        if ($this->businessLegalEntity) {
            $query->where('application_data->business_legal_entity', $this->businessLegalEntity);
        }

        // Filter by Industry
        if ($this->industry) {
            $query->where('application_data->business_industry', $this->industry);
        }

        // Sorting Logic
        if ($this->sort === 'rating') {
            $query->orderBy('created_at', 'desc');
        }

        $businessProfiles = $query->paginate(9);

        return view('livewire.business-profile-filter', [
            'businessProfiles' => $businessProfiles,
        ]);
    }
}
