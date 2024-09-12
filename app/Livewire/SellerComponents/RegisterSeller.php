<?php

namespace App\Livewire\SellerComponents;

use Livewire\Component;
use Filament\Forms\Form;
use Livewire\WithFileUploads;
use App\Models\BusinessProfile;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class RegisterSeller extends Component implements HasForms
{
    use InteractsWithForms , WithFileUploads;



    public $user_id;
    public $clientInfo;
    public $businessInfo;
    public $transactionalinfo;
    public $documentsinfo;
    public $businessinfo;
    public $selectaplan;
    public $step = 1; // Track the current step
    public $name, $company_name, $mobile_number, $email;
    public $seller_role, $seller_interest, $business_start_date, $business_industry;
    public $business_photos, $information_memorandum, $financial_report, $valuation_worksheets;



    public function mount()
    {
        $this->form->fill([
            'business_photos' => [],
            'information_memorandum' => null,
            'financial_report' => null,
            'valuation_worksheets' => null,
        ]);
    }




    public function validateData()
    {
        return $this->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
            'email' => 'required|email|unique:business_profiles,email',
            'display_company_details' => 'nullable|string',
            'seller_role' => ['required'],
            'seller_interest' => 'required|string',
            'business_start_date' => 'required|date',
            'business_industry' => 'required|string',
            'country' => 'required|string',
            'city' => 'required|string',
            'county' => 'required|string',
            'number_employees' => 'required|integer',
            'business_legal_entity' => 'required|string',
            'website_link' => 'nullable|url',
            'business_description' => 'required|string',
            'product_services' => 'required|string',
            'business_highlights' => 'required|string',
            'facility_description' => 'required|string',
            'business_funds' => 'required|string',
            'number_shareholders' => 'required|string',
            'monthly_turnover' => 'required|string',
            'yearly_turnover' => 'required|string',
            'profit_margin' => 'required|string',
            'tangible_assets' => 'required|string',
            'liabilities' => 'required|string',
            'physical_assets' => 'required|string',
            'interested_in_quotations' => 'nullable|string',
            'business_photos' => 'nullable|string',
            'information_memorandum' => 'nullable|string',
            'financial_report' => 'nullable|string',
            'valuation_worksheets' => 'nullable|string',
            'active_business' => 'nullable|string',
            'reason_for_decline' => 'nullable|string',
        ]);
    }


    public function form(Form $form): Form
{
    return $form
        ->schema([
            Wizard::make([
                Wizard\Step::make('Client Information')
                ->description('Client info')
                    ->schema([

                        Shout::make('clientInfo')
                        ->columnSpanFull()
                        ->content("Please enter your own details here. Information entered here is not publicly displayed."),

                        TextInput::make('name')
                        ->required()
                        ->label('Name'),
                    TextInput::make('company_name')
                        ->required()
                        ->label('Company Name'),
                    TextInput::make('mobile_number')
                        ->required()
                        ->label('Mobile Number'),
                    TextInput::make('email')
                        ->required()
                        ->label('Email'),
                        Checkbox::make('display_company_details')
                        ->label('Display company details to introduced members so that they can know about my company')
                        ->columnSpan('full')

                        // ...
                    ])->columns(2),
                Wizard\Step::make('Business Information')
                    ->schema([

                        Shout::make('businessinfo')
                        ->columnSpanFull()
                        ->content("Information entered here is displayed publicly to match you with the right set of investors and buyers. Do not mention business name/information which can identify the business."),

                        Select::make('seller_role')
                            ->options([
                                'Director' => 'Director',
                                'Adviser' => 'Adviser',
                                'Shareholder' => 'Shareholder',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->label('Seller Role'),
                        TextInput::make('seller_interest')
                            ->required()
                            ->label('Seller Interest'),
                        DatePicker::make('business_start_date')
                            ->required()
                            ->label('Business Start Date'),
                        TextInput::make('business_industry')
                            ->required()
                            ->label('Business Industry'),
                        TextInput::make('country')
                            ->required()
                            ->label('Country'),
                        TextInput::make('city')
                            ->required()
                            ->label('City'),
                        TextInput::make('county')
                            ->required()
                            ->label('County'),
                        TextInput::make('number_employees')
                            ->required()
                            ->label('Number of Employees'),
                        TextInput::make('business_legal_entity')
                            ->required()
                            ->label('Business Legal Entity'),
                        TextInput::make('website_link')
                            ->label('Website Link'),
                            Textarea::make('business_description')
                            ->required()
                            ->label('Business Description'),
                        Textarea::make('product_services')
                            ->required()
                            ->label('Product/Services'),
                        Textarea::make('business_highlights')
                            ->label('Business Highlights'),
                        Textarea::make('facility_description')
                            ->label('Facility Description'),


                        // ...
                    ])->columns(2),
                Wizard\Step::make('Transactional information')
                    ->schema([
                        Shout::make('transactionalinfo')
                        ->columnSpanFull()
                        ->content("Please enter your own details here. Information entered here is not publicly displayed."),
                        TextInput::make('business_funds')
                        ->label('Business Funds'),
                    TextInput::make('number_shareholders')
                        ->label('Number of Shareholders'),
                    TextInput::make('monthly_turnover')
                        ->label('Monthly Turnover'),
                    TextInput::make('yearly_turnover')
                        ->label('Yearly Turnover'),
                    TextInput::make('profit_margin')
                        ->label('Profit Margin'),
                    TextInput::make('tangible_assets')
                        ->label('Tangible Assets'),
                    TextInput::make('liabilities')
                        ->label('Liabilities'),
                    TextInput::make('physical_assets')
                        ->label('Physical Assets'),
                    Checkbox::make('interested_in_quotations')
                        ->label('Interested in Quotations'),
                    ])->columns(2),
                    Wizard\Step::make('Documents')
                    ->schema([

                        Shout::make('documentsinfo')
                        ->columnSpanFull()
                        ->content("Photos are an important part of your profile and are publicly displayed. Documents help us verify and approve your profile faster. Documents names entered here are publicly visible but are accessible only to introduced members."),
                        FileUpload::make('business_photos')
                        ->label('Business Photos')->required(),
                    FileUpload::make('information_memorandum')
                        ->label('Information Memorandum'),
                    FileUpload::make('financial_report')
                        ->label('Financial Report'),
                    FileUpload::make('valuation_worksheets')
                        ->label('Valuation Worksheets'),
                    ])->columns(2),
                    Wizard\Step::make('Select a plan')
                    ->schema([
                        Shout::make('selectaplan')
                        ->columnSpanFull(),
                        Checkbox::make('active_business')
                        ->label('Active Business'),
                    Hidden::make('verification_status')
                        ->default('Pending'),
                    ]),

            ])->skippable()->submitAction(new HtmlString('<button type="submit" style="background-color:red;">Submit</button>'))
        ]);
}


public function submit(): void
{

    // dd($this->form->getState());
    $validatedData = $this->validateData();

    dd($validatedData);

    // // Create or update the BusinessProfile record
    // $businessProfile = BusinessProfile::updateOrCreate(
    //     ['user_id' => auth()->user->id],
    //     $validatedData
    // );

    // // Handle success or failure
    // if ($businessProfile) {
    //     // Redirect or show a success message
    // } else {
    //     // Handle errors
    // }
}

    public function render()
    {
        return view('livewire.seller-components.register-seller');
    }
}
