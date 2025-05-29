<?php

namespace App\Livewire\SellerComponents;

use Carbon\Carbon;
use App\Models\User;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Forms\Form;
use Livewire\WithFileUploads;
use App\Models\BusinessProfile;
use Illuminate\Support\HtmlString;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use App\Notifications\BusinessSellerSignup;
use App\Notifications\ApplicationUnderReview;
use Filament\Forms\Concerns\InteractsWithForms;

class RegisterSeller extends Component implements HasForms
{
    use InteractsWithForms, WithFileUploads;

    // System Properties
    public $user_id;
    public $formData = [];

    // UI State Properties
    public $clientInfo;
    public $businessInfo;
    public $transactionalinfo;
    public $documentsinfo;
    public $businessinfo;
    public $selectaplan;
    public $review_info;
    public $confirmation;

    // Contact Information
    public $name;
    public $company_name;
    public $mobile_number;
    public $email;
    public $display_company_details;
    public $display_contact_details;

    // Business Information
    public $seller_role;
    public $other_seller_role;
    public $seller_interest;
    public $business_start_date;
    public $business_industry;
    public $other_business_industry;
    public $country;
    public $city;
    public $town;
    public $number_employees;
    public $business_legal_entity;
    public $other_business_legal_entity;
    public $website_link;
    public $business_description;
    public $product_services;
    public $business_highlights;
    public $facility_description;

    // Seller Interest Specific Fields
    public $tentative_selling_price;
    public $reason_for_sale;
    public $maximum_stake;
    public $investment_amount;
    public $reason_for_investment;
    public $value_of_physical_assets;
    public $asset_selling_price;
    public $reason_for_selling_assets;
    public $colateral_value;
    public $loan_amount;
    public $yearly_interest_pay;
    public $years_repay_loan;
    public $reason_for_seeking_loan;

    // Transactional Information
    public $business_funds;
    public $number_shareholders;
    public $monthly_turnover;
    public $yearly_turnover;
    public $profit_margin;
    public $tangible_assets;
    public $liabilities;
    public $physical_assets;
    public $interested_in_quotations;

    // Documents
    public $business_photos;
    public $information_memorandum;
    public $valuation_worksheets;
    public $business_profile;
    public $certificate_of_incorporation;
    public $kra_pin;
    public $valuation_report;

    // System Fields
    public $verification_status;
    public $reason_for_decline;
    public $finders_fee;
    public $active_business;


    // Terms
    public $terms_of_engagement;


    public function mount()
    {
        $this->form->fill([
            'business_photos' => [],
            'certificate_of_incorporation' => null,
            'business_legal_entity' => null,
            'business_industry' => null
        ]);
    }

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'company_name' => 'required|string|max:255',
        'mobile_number' => 'required|string|max:20',
        'email' => 'required|email|unique:business_profiles,email',
        'display_company_details' => 'nullable|boolean',
        'display_contact_details' => 'nullable|boolean',
        'seller_role' => 'required|in:Director,Adviser,Shareholder,Other',
        'seller_interest' => 'required|string|max:255',
        'tentative_selling_price' => 'nullable|numeric|min:0|max:999999999999.99',
        'reason_for_sale' => 'nullable|string',
        'maximum_stake' => 'nullable|numeric|min:0|max:100',
        'investment_amount' => 'nullable|numeric|min:0|max:999999999999.99',
        'reason_for_investment' => 'nullable|string',
        'value_of_physical_assets' => 'nullable|numeric|min:0|max:999999999999.99',
        'asset_selling_price' => 'nullable|numeric|min:0|max:999999999999.99',
        'reason_for_selling_assets' => 'nullable|string',
        'colateral_value' => 'nullable|numeric|min:0|max:999999999999.99',
        'loan_amount' => 'nullable|numeric|min:0|max:999999999999.99',
        'yearly_interest_pay' => 'nullable|numeric|min:0|max:999999999999.99',
        'years_repay_loan' => 'nullable|integer|min:0',
        'reason_for_seeking_loan' => 'nullable|string',
        'business_start_date' => 'required|string',
        'business_industry' => 'required|string|max:255',
        'country' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'town' => 'required|string|max:255',
        'number_employees' => 'required|integer|min:0',
        'business_legal_entity' => 'required|string|max:255',
        'website_link' => 'nullable|url|max:255',
        'business_description' => 'required|string',
        'facility_description' => 'nullable|string',
        'business_funds' => 'required|string',
        'number_shareholders' => 'required|file|mimes:pdf|max:1024',
        'monthly_turnover' => 'required|numeric|min:0',
        'yearly_turnover' => 'required|numeric|min:0',
        'profit_margin' => 'required|numeric',
        'tangible_assets' => 'required|file|mimes:pdf|max:1024',
        'liabilities' => 'required|file|mimes:pdf|max:1024',
        'physical_assets' => 'required|numeric|min:0',
        'interested_in_quotations' => 'nullable|boolean',
        'business_photos' => 'required|array|min:5|max:7',
        'business_photos.*' => 'image|mimes:jpeg,png,webp|max:2048',
        'business_profile' => 'required|file|mimes:pdf|max:1024',
        'kra_pin' => 'required|file|mimes:pdf|max:1024',
        'certificate_of_incorporation' => 'required|file|mimes:pdf|max:1024',
        'valuation_report' => 'required|file|mimes:pdf|max:1024',
        'other_seller_role' => 'nullable|string|max:255',
        'other_business_industry' => 'nullable|string|max:255',
        'other_business_legal_entity' => 'nullable|string|max:255',
        'finders_fee' => 'required|boolean',
        'verification_status' => 'nullable|string|in:Pending,Approved,Declined',
    ];

    public function submit()
    {

        // Check if user already has an investor profile
    if (BusinessProfile::where('user_id', auth()->user()->id)->exists()) {
        session()->flash('error', 'You already have a business profile registered.');
        return redirect()->route('businessVerificationCallPage');
    }
        $formData = $this->form->getState();

        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Validate the form data
        $this->form->validate();

        // Move file-related fields into the documents array
        $documents = [
            'business_profile' => $formData['business_profile'] ?? null,
            'kra_pin' => $formData['kra_pin'] ?? null,
            'certificate_of_incorporation' => $formData['certificate_of_incorporation'] ?? null,
            'valuation_report' => $formData['valuation_report'] ?? null,
            'business_photos' => $formData['business_photos'] ?? null,
            'number_shareholders' => $formData['number_shareholders'] ?? null,
            'tangible_assets' => $formData['tangible_assets'] ?? null,
            'liabilities' => $formData['liabilities'] ?? null,
        ];

        // Collect non-file fields into application_data, excluding the file-related fields
        $applicationData = collect($formData)->except([
            'business_profile',
            'kra_pin',
            'certificate_of_incorporation',
            'valuation_report',
            'business_photos',
            'display_contact_details',
            'number_shareholders',
            'tangible_assets',
            'liabilities',
            'finders_fee',
        ])->toArray();

        // Create the business profile
        BusinessProfile::create([
            'user_id' => auth()->user()->id,
            'email' => $formData['email'],
            'status' => 'pending',
            'verification_status' => $formData['verification_status'] ?? 'Pending',
            'application_data' => $applicationData,
            'documents' => $documents,
            'business_industry' => $formData['business_industry'] ?? null,
            'business_start_date' => $formData['business_start_date'] ?? null,
            'tentative_selling_price' => $formData['tentative_selling_price'] ?? null,
            'maximum_stake' => $formData['maximum_stake'] ?? null,
            'finders_fee' => $formData['finders_fee'] ?? false,
        ]);

        // Send notifications
        $user = auth()->user();
        $user->notify(new ApplicationUnderReview($user));

        $admin = User::where('registration_type', 'Admin')->first();
        if ($admin) {
            $admin->notify(new BusinessSellerSignup($user));
        }

        // Redirect to verification call page
        return redirect()->route('businessVerificationCallPage');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('Contact Person Information')
                        ->icon('heroicon-m-user')
                        ->completedIcon('heroicon-o-hand-thumb-up')
                        ->schema([
                            Shout::make('clientInfo')
                                ->columnSpanFull()
                                ->content("Please enter your personal details here. The information provided will remain confidential and will not be publicly displayed."),

                            TextInput::make('name')
                                ->required()
                                ->label('Contact person name'),

                            TextInput::make('company_name')
                                ->hint('Why is this needed?')
                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'This information is required for our verification process. Biasharamat may ask for supporting documentation without which we are unable to activate your profile. This information is never disclosed to anyone without your permission.')
                                ->required()
                                ->label('Company name'),

                            TextInput::make('mobile_number')
                                ->hint('Why is this needed?')
                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: "We'll use this to contact you for verification and activation of your account. We will never share your number with telemarketers.")
                                ->required()
                                ->label('Contact person mobile number'),

                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->hint('Why is this needed?')
                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: "Enter a valid official email address to ensure your profile is prioritized and verified faster. Please note that this email address is used only for verification purposes and all email communications will be sent only to your registered email address.")
                                ->label('Official email for quick verification'),

                            Checkbox::make('display_contact_details')
                                ->label('Display contact details to investors so that they can contact me directly')
                                ->columnSpan('full'),

                            Checkbox::make('display_company_details')
                                ->label('Display company details to investors so that they can know about my company')
                                ->columnSpan('full')
                        ])->columns(2),

                    Wizard\Step::make('Business Information')
                        ->completedIcon('heroicon-o-hand-thumb-up')
                        ->icon('heroicon-m-briefcase')
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
                                ->live()
                                ->label('You are a(n)')
                                ->afterStateUpdated(function (Set $set, $state) {
                                    $set('other_seller_role', null);
                                }),

                            TextInput::make('other_seller_role')
                                ->hidden(function(Get $get){
                                    return $get('seller_role') != "Other";
                                })
                                ->label('Specify role'),

                            Select::make('seller_interest')
                                ->label('What are you interested in')
                                ->live()
                                ->options([
                                    'Sale of shares' => 'Sale of shares',
                                    'Partial sale of shares' => 'Partial sale of shares',
                                    'Sale of assets' => 'Sale of assets',
                                    'Financing' => 'Financing',
                                ]),

                            // Sale of shares fields
                            TextInput::make('tentative_selling_price')
                                ->label('What is the tentative selling price for the business?')
                                ->numeric()
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Sale of shares');
                                }),

                            Textarea::make('reason_for_sale')
                                ->label('What is the reason for the sale of the business?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Sale of shares');
                                }),

                            // Partial sale of shares fields
                            TextInput::make('maximum_stake')
                                ->label('What is the maximum stake that you are willing to sell?')
                                ->numeric()
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Partial sale of shares');
                                }),

                            TextInput::make('investment_amount')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What investment amount are you seeking for this stake')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Partial sale of shares');
                                }),

                            Textarea::make('reason_for_investment')
                                ->label('Provide reason for investment?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Partial sale of shares');
                                }),

                            // Sale of assets fields
                            TextInput::make('value_of_physical_assets')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What is the value of the physical assets you are selling?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Sale of assets');
                                }),

                            TextInput::make('asset_selling_price')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('At what price are you selling/leasing?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Sale of assets');
                                }),

                            Textarea::make('reason_for_selling_assets')
                                ->label('What is the reason for selling the business assets?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Sale of assets');
                                }),

                            // Financing fields
                            TextInput::make('colateral_value')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What is the value of the collateral you can provide?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Financing');
                                }),

                            TextInput::make('loan_amount')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What loan amount are you seeking?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Financing');
                                }),

                            TextInput::make('yearly_interest_pay')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What is the maximum yearly interest you can pay?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Financing');
                                }),

                            TextInput::make('years_repay_loan')
                                ->numeric()
                                ->label('In how many years will you repay the loan?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Financing');
                                }),

                            Textarea::make('reason_for_seeking_loan')
                                ->label('Reason for seeking a loan?')
                                ->hidden(function (Get $get) {
                                    return !($get('seller_interest') === 'Financing');
                                }),

                            Select::make('business_start_date')
                                ->required()
                                ->label('When was the business established?')
                                ->options(array_merge(
                                    ['Not operational yet' => 'Not operational yet'],
                                    array_combine(
                                        range(date('Y'), date('Y') - 50),
                                        range(date('Y'), date('Y') - 50)
                                    )
                                )),

                            Select::make('business_industry')
                                ->label('Select business industry')
                                ->live()
                                ->options(function () {
                                    $data = json_decode(Storage::disk('local')->get('data/business_industries.json'), true);
                                    return $data;
                                }),

                            TextInput::make('other_business_industry')
                                ->hidden(function(Get $get){
                                    return $get('business_industry') != "Other";
                                })
                                ->label('Specify business industry'),

                            Fieldset::make('Where is the business located / headquartered?')
                                ->schema([
                                    Select::make('country')
                                        ->label('Country')
                                        ->required()
                                        ->live()
                                        ->options(function () {
                                            $data = collect(json_decode(Storage::disk('local')->get('data/countries.json'), true));
                                            return $data->keys()->mapWithKeys(fn ($country) => [$country => $country])->toArray();
                                        })
                                        ->afterStateUpdated(function (Set $set, $state) {
                                            $set('city', null);
                                        }),

                                    Select::make('city')
                                        ->label('City')
                                        ->required()
                                        ->live()
                                        ->options(function (callable $get) {
                                            $country = $get('country');
                                            if ($country) {
                                                $data = json_decode(Storage::disk('local')->get('data/countries.json'), true);
                                                $cities = $data[$country] ?? [];
                                                return array_combine($cities, $cities);
                                            }
                                            return [];
                                        })
                                        ->afterStateUpdated(function (Set $set, $state) {
                                            $set('city', $state);
                                        }),

                                    TextInput::make('town')
                                        ->required()
                                        ->label('Town/Location'),
                                ])
                                ->columns(3),

                            Grid::make(3)
                                ->schema([
                                    TextInput::make('number_employees')
                                        ->required()
                                        ->numeric()
                                        ->label('How many employees does the business have?'),

                                    Select::make('business_legal_entity')
                                        ->label('Select business legal entity type')
                                        ->live()
                                        ->options(function () {
                                            $data = json_decode(Storage::disk('local')->get('data/business_legal_entities.json'), true);
                                            return $data;
                                        }),

                                    TextInput::make('other_business_legal_entity')
                                        ->hidden(function(Get $get){
                                            return $get('business_legal_entity') != "Other";
                                        })
                                        ->live()
                                        ->label('Specify business legal entity'),

                                    TextInput::make('website_link')
                                        ->url()
                                        ->label('Link to your business website'),
                                ]),

                            Textarea::make('business_description')
                                ->required()
                                ->placeholder('Share what your business does, its industry, and key activities.')
                                ->label('Tell us about your business'),

                            Textarea::make('facility_description')
                                ->label('Describe your facility such as built-up area, number of floors, Indicate whether rental or lease.'),
                        ])->columns(2),

                    Wizard\Step::make('Transactional Information')
                        ->icon('heroicon-m-banknotes')
                        ->completedIcon('heroicon-o-hand-thumb-up')
                        ->schema([
                            Shout::make('transactionalinfo')
                                ->columnSpanFull()
                                ->content("Please enter your own details here. Information entered here is not publicly displayed."),

                            Textarea::make('business_funds')
                                ->label('How is the business funded presently? Mention all debts, securities registered, equity funding, etc.'),

                            FileUpload::make('number_shareholders')
                                ->label('Upload the current list of shareholders and shareholding')
                                ->required()
                                ->acceptedFileTypes(['application/pdf']),

                            TextInput::make('monthly_turnover')
                                ->numeric()
                                ->label('At present, what is your average monthly turnover?')
                                ->hint('Why is this needed?')
                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: "Investors/Buyers evaluate your business proposal based on this information. It is best to communicate this information upfront instead of wasting your time and theirs."),

                            TextInput::make('yearly_turnover')
                                ->numeric()
                                ->label('Indicate turnover for the preceding year')
                                ->hint('Why is this needed?')
                                ->hintIcon('heroicon-m-question-mark-circle', tooltip: "Investors/Buyers evaluate your business proposal based on this information. It is best to communicate this information upfront instead of wasting your time and theirs."),

                            TextInput::make('profit_margin')
                                ->numeric()
                                ->postfix('%')
                                ->label('What is the EBITDA / Operating Profit Margin Percentage or Last Reported Profit Margin Percentage'),

                            FileUpload::make('tangible_assets')
                                ->label('Upload the list of tangible and intangible assets of the business')
                                ->required()
                                ->acceptedFileTypes(['application/pdf']),

                            FileUpload::make('liabilities')
                                ->label('Upload the list of liabilities of the business')
                                ->required()
                                ->acceptedFileTypes(['application/pdf']),

                            TextInput::make('physical_assets')
                                ->numeric()
                                ->label('What is the value of physical assets owned by the business that would be part of the transaction?'),
                        ])->columns(2),

                    Wizard\Step::make('Documents')
                        ->icon('heroicon-m-document')
                        ->completedIcon('heroicon-o-hand-thumb-up')
                        ->schema([
                            Shout::make('documentsinfo')
                                ->columnSpanFull()
                                ->content("Photos are an important part of your profile and are publicly displayed. Documents help us verify and approve your profile faster. Documents names entered here are publicly visible but are accessible only to introduced members."),

                            FileUpload::make('business_photos')
                                ->required()
                                ->label('Photos of the business premises (Min: 5, Max: 7, File type .jpeg,.png .webp)')
                                ->image()
                                ->downloadable()
                                ->multiple()
                                ->minFiles(5)
                                ->maxFiles(7),

                            FileUpload::make('business_profile')
                                ->acceptedFileTypes(['application/pdf'])
                                ->required()
                                ->label('Business profile'),

                            FileUpload::make('kra_pin')
                                ->acceptedFileTypes(['application/pdf'])
                                ->required()
                                ->label('KRA pin'),

                            FileUpload::make('certificate_of_incorporation')
                                ->acceptedFileTypes(['application/pdf'])
                                ->required()
                                ->label('Certificate of Incorporation'),

                            FileUpload::make('valuation_report')
                                ->acceptedFileTypes(['application/pdf'])
                                ->required()
                                ->label('Valuation report'),
                        ])->columns(2),

                    Wizard\Step::make('Review Information')
                        ->icon('heroicon-m-document-check')
                        ->completedIcon('heroicon-o-hand-thumb-up')
                        ->schema([
                            Shout::make('review_info')
                                ->columnSpanFull()
                                ->content("Please review all the information you've provided before submitting."),

                            Section::make('Client Information')
                                ->schema([
                                    Placeholder::make('review_name')
                                        ->label('Contact Person Name')
                                        ->content(fn (Get $get): string => $get('name') ?? 'Not provided'),
                                    Placeholder::make('review_company_name')
                                        ->label('Company Name')
                                        ->content(fn (Get $get): string => $get('company_name') ?? 'Not provided'),
                                    Placeholder::make('review_mobile_number')
                                        ->label('Contact Mobile Number')
                                        ->content(fn (Get $get): string => $get('mobile_number') ?? 'Not provided'),
                                    Placeholder::make('review_email')
                                        ->label('Official Email')
                                        ->content(fn (Get $get): string => $get('email') ?? 'Not provided'),
                                ])
                                ->columns(2),

                            Section::make('Business Information')
                                ->schema([
                                    Placeholder::make('review_seller_role')
                                        ->label('Your Role')
                                        ->content(fn (Get $get): string => $get('seller_role') ?? 'Not provided'),
                                    Placeholder::make('review_seller_interest')
                                        ->label('Interest Type')
                                        ->content(fn (Get $get): string => $get('seller_interest') ?? 'Not provided'),
                                    Placeholder::make('review_business_industry')
                                        ->label('Industry')
                                        ->content(fn (Get $get): string => $get('business_industry') ?? 'Not provided'),
                                    Placeholder::make('review_business_start_date')
                                        ->label('Establishment Date')
                                        ->content(fn (Get $get): string => $get('business_start_date') ?? 'Not provided'),
                                    Placeholder::make('review_country')
                                        ->label('Country')
                                        ->content(fn (Get $get): string => $get('country') ?? 'Not provided'),
                                    Placeholder::make('review_city')
                                        ->label('City')
                                        ->content(fn (Get $get): string => $get('city') ?? 'Not provided'),
                                    Placeholder::make('review_number_employees')
                                        ->label('Number of Employees')
                                        ->content(fn (Get $get): string => (string) $get('number_employees') ?? 'Not provided'),
                                    Placeholder::make('review_business_description')
                                        ->label('Business Description')
                                        ->content(fn (Get $get): string => $get('business_description') ?? 'Not provided'),
                                ])
                                ->columns(2),

                            Section::make('Financial Information')
                                ->schema([
                                    Placeholder::make('review_monthly_turnover')
                                        ->label('Monthly Turnover')
                                        ->content(fn (Get $get): string => is_numeric($get('monthly_turnover')) ? 'Ksh ' . number_format((float) $get('monthly_turnover'), 2) : 'Not provided'),
                                    Placeholder::make('review_yearly_turnover')
                                        ->label('Yearly Turnover')
                                        ->content(fn (Get $get): string => is_numeric($get('yearly_turnover')) ? 'Ksh ' . number_format((float) $get('yearly_turnover'), 2) : 'Not provided'),
                                    Placeholder::make('review_profit_margin')
                                        ->label('Profit Margin')
                                        ->content(fn (Get $get): string => is_numeric($get('profit_margin')) ? $get('profit_margin') . '%' : 'Not provided'),
                                    Placeholder::make('review_physical_assets')
                                        ->label('Physical Assets Value')
                                        ->content(fn (Get $get): string => is_numeric($get('physical_assets')) ? 'Ksh ' . number_format((float) $get('physical_assets'), 2) : 'Not provided'),
                                ])
                                ->columns(2),

                            Section::make('Sale Information')
                                ->schema([
                                    Placeholder::make('review_tentative_selling_price')
                                        ->label('Selling Price')
                                        ->content(fn (Get $get): string => is_numeric($get('tentative_selling_price')) ? 'Ksh ' . number_format((float) $get('tentative_selling_price'), 2) : 'Not provided')
                                        ->visible(fn (Get $get) => $get('seller_interest') === 'Sale of shares'),
                                    Placeholder::make('review_maximum_stake')
                                        ->label('Maximum Stake')
                                        ->content(fn (Get $get): string => is_numeric($get('maximum_stake')) ? $get('maximum_stake') . '%' : 'Not provided')
                                        ->visible(fn (Get $get) => $get('seller_interest') ==='Partial sale of shares'),
                                    Placeholder::make('review_investment_amount')
                                        ->label('Investment Amount')
                                        ->content(fn (Get $get): string => is_numeric($get('investment_amount')) ? 'Ksh ' . number_format((float) $get('investment_amount'), 2) : 'Not provided')
                                        ->visible(fn (Get $get) => $get('seller_interest') === 'Partial sale of shares'),
                                    Placeholder::make('review_value_of_physical_assets')
                                        ->label('Physical Assets Value')
                                        ->content(fn (Get $get): string => is_numeric($get('value_of_physical_assets')) ? 'Ksh ' . number_format((float) $get('value_of_physical_assets'), 2) : 'Not provided')
                                        ->visible(fn (Get $get) => $get('seller_interest') === 'Sale of assets'),
                                    Placeholder::make('review_asset_selling_price')
                                        ->label('Asset Selling Price')
                                        ->content(fn (Get $get): string => is_numeric($get('asset_selling_price')) ? 'Ksh ' . number_format((float) $get('asset_selling_price'), 2) : 'Not provided')
                                        ->visible(fn (Get $get) => $get('seller_interest') === 'Sale of assets'),
                                    Placeholder::make('review_loan_amount')
                                        ->label('Loan Amount')
                                        ->content(fn (Get $get): string => is_numeric($get('loan_amount')) ? 'Ksh ' . number_format((float) $get('loan_amount'), 2) : 'Not provided')
                                        ->visible(fn (Get $get) => $get('seller_interest') === 'Financing'),
                                    Placeholder::make('review_colateral_value')
                                        ->label('Collateral Value')
                                        ->content(fn (Get $get): string => is_numeric($get('colateral_value')) ? 'Ksh ' . number_format((float) $get('colateral_value'), 2) : 'Not provided')
                                        ->visible(fn (Get $get) => $get('seller_interest') === 'Financing'),
                                ])
                                ->columns(2)
                                ->visible(fn (Get $get) => $get('seller_interest')),

                            Section::make('Uploaded Documents')
                                ->schema([
                                    Placeholder::make('review_business_photos')
                                        ->label('Business Photos')
                                        ->content(fn (Get $get): string => $get('business_photos') ? 'Uploaded' : 'Not uploaded'),
                                    Placeholder::make('review_business_profile')
                                        ->label('Business Profile')
                                        ->content(fn (Get $get): string => $get('business_profile') ? 'Uploaded' : 'Not uploaded'),
                                    Placeholder::make('review_kra_pin')
                                        ->label('KRA Pin')
                                        ->content(fn (Get $get): string => $get('kra_pin') ? 'Uploaded' : 'Not uploaded'),
                                    Placeholder::make('review_certificate_of_incorporation')
                                        ->label('Certificate of Incorporation')
                                        ->content(fn (Get $get): string => $get('certificate_of_incorporation') ? 'Uploaded' : 'Not uploaded'),
                                    Placeholder::make('review_valuation_report')
                                        ->label('Valuation Report')
                                        ->content(fn (Get $get): string => $get('valuation_report') ? 'Uploaded' : 'Not uploaded'),
                                ])
                                ->columns(2),

                            Shout::make('confirmation')
                                ->columnSpanFull()
                                ->content('By proceeding to submit, you confirm that all the information provided is accurate and complete.')
                                ->type('info'),
                        ]),

                    Wizard\Step::make('Terms & Conditions')
                        ->icon('heroicon-m-document-text')
                        ->completedIcon('heroicon-o-hand-thumb-up')
                        ->schema([

                            Radio::make('active_business')
                            ->label('Select a plan')
                            ->options([
                                '12000' => 'Monthly 12,000',
                                '143999' => 'Yearly (recommended 143,999)',
                            ])
                            ->required(),
                            Checkbox::make('finders_fee')
                                ->label("I undertake to pay 1% finder's fee (payable post transaction) to Biasharamart and accept the terms of engagement")
                                ->required()
                                ->inline(),

                            Hidden::make('verification_status')
                                ->default('Pending'),
                        ]),
                ])
                ->persistStepInQueryString()
                ->submitAction(new HtmlString('<button type="submit" style="background-color:#c75126; color:white; border-radius:5px; padding-top:5px; padding-bottom:5px; padding-right:10px; padding-left:10px;">Submit Application</button>'))
            ]);
    }

    public function render()
    {
        return view('livewire.seller-components.register-seller');
    }
}