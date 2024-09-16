<?php

namespace App\Livewire\SellerComponents;

use Carbon\Carbon;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Forms\Form;
use Livewire\WithFileUploads;
use App\Models\BusinessProfile;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Http\Controllers\PaymentController;
use Filament\Forms\Components\DateTimePicker;
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
    public $name;
    public $company_name;
    public $mobile_number;
    public $email;
    public $display_company_details;
    public $seller_role;
    public $seller_interest;
    public $business_start_date;
    public $business_industry;
    public $country;
    public $city;
    public $county;
    public $number_employees;
    public $business_legal_entity;
    public $website_link;
    public $business_description;
    public $product_services;
    public $business_highlights;
    public $facility_description;
    public $business_funds;
    public $number_shareholders;
    public $monthly_turnover;
    public $yearly_turnover;
    public $profit_margin;
    public $tangible_assets;
    public $liabilities;
    public $physical_assets;
    public $interested_in_quotations;
    public $business_photos;
    public $information_memorandum;
    public $financial_report;
    public $valuation_worksheets;
    public $active_business;
    public $reason_for_decline;
    public $verification_status;
    public $display_contact_details;
    public $finders_fee;



    public function mount()
    {
        $this->form->fill([
            'business_photos' => [],
            'information_memorandum' => null,
            'financial_report' => null,
            'valuation_worksheets' => null,
        ]);


    }


    public function submit(){
        $formData =$this->form->getState();
        BusinessProfile::create([
            'user_id' => auth()->user()->id,
            'name' => $formData['name'],
            'company_name' => $formData['company_name'],
            'mobile_number' => $formData['mobile_number'],
            'email' => $formData['email'],
            'display_company_details' => $formData['display_company_details'] ?? null,
            'seller_role' => $formData['seller_role'],
            'seller_interest' => $formData['seller_interest'],
            'business_start_date' => $formData['business_start_date'],
            'business_industry' => $formData['business_industry'],
            'country' => $formData['country'],
            'city' => $formData['city'],
            'county' => $formData['county'],
            'number_employees' => $formData['number_employees'],
            'business_legal_entity' => $formData['business_legal_entity'],
            'website_link' => $formData['website_link'],
            'business_description' => $formData['business_description'],
            'product_services' => $formData['product_services'],
            'business_highlights' => $formData['business_highlights'],
            'facility_description' => $formData['facility_description'],
            'business_funds' => $formData['business_funds'],
            'number_shareholders' => $formData['number_shareholders'],
            'monthly_turnover' => $formData['monthly_turnover'],
            'yearly_turnover' => $formData['yearly_turnover'],
            'profit_margin' => $formData['profit_margin'],
            'tangible_assets' => $formData['tangible_assets'],
            'liabilities' => $formData['liabilities'],
            'physical_assets' => $formData['physical_assets'],
            'interested_in_quotations' => $formData['interested_in_quotations'] ?? null,
            'business_photos' => $formData['business_photos'] ?? null,
            'information_memorandum' => $formData['information_memorandum'] ?? null,
            'financial_report' => $formData['financial_report'] ?? null,
            'valuation_worksheets' => $formData['valuation_worksheets'] ?? null,
            'active_business' => $formData['active_business'],
            'verification_status' => $formData['verification_status'] ?? 'Pending',
        ]);

          // Call PaymentController methods to handle the payment process
          $paymentController = new PaymentController();

          // Get access token
          $token = $paymentController->generateAccessToken();
          if (!$token) {
              return session()->flash('error', 'Failed to get access token');
          }

          // Register IPN
          $ipnId = $paymentController->registerIPN($token);
          if (!$ipnId) {
              return session()->flash('error', 'Failed to register IPN');
          }

          // Prepare order data
          $orderData = [
            'amount' => 1.00,
            'description' => 'Payment for service',
            'callback_url' => 'https://a9fb-41-90-228-219.ngrok-free.app/verification-call-page',
            'branch' => 'Town Branch',
            'first_name' => 'Hardy',
            'middle_name' => 'Kathurima',
            'last_name' => 'Kimaita',
            'email_address' => 'hardykathurima@gmail.com',
            'phone_number' => '0703642687'
          ];

          // Submit Order
          $redirectUrl = $paymentController->submitOrder($token, $ipnId, $orderData);
          if (!$redirectUrl) {
              return session()->flash('error', 'Failed to submit order');
          }

          // Redirect to payment URL
          return redirect()->to($redirectUrl);










    }





    public function form(Form $form): Form
{
    return $form
        ->schema([
            Wizard::make([
                Wizard\Step::make('Client Information')

                ->icon('heroicon-m-user')
                ->completedIcon('heroicon-m-user')
                    ->schema([

                        Shout::make('clientInfo')
                        ->columnSpanFull()
                        ->content("Please enter your personal details here. The information provided will remain confidential and will not be publicly displayed."),

                        TextInput::make('name')
                        ->required()
                        ->label('Name')->reactive()
                        ->afterStateUpdated(fn ($state) => $this->validateOnly('name')),
                    TextInput::make('company_name')
                    ->hint('Why is this needed?')
                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'This information is required for our verification process. Biasharamat may ask for supporting documentation without which we are unable to activate your profile. This information is never disclosed to anyone without your permission.')
                        ->required()
                        ->label('Company name'),
                    TextInput::make('mobile_number')
                    // ->tel()
                    // ->telRegex('/^(0|\+254)7[0-9]{7}$/')
                    ->hint('Why is this needed?')
                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: "We'll use this to contact you for verification and activation of your account. We will never share your number with telemarketers.")
                        ->required()
                        ->label('Your mobile number'),
                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->hint('Why is this needed?')
                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: "Enter a valid official email address to ensure your profile is prioritized and verified faster. Please note that this email address is used only for verification purposes and all email communications will be sent only to your registered email address.")
                        ->label('Official email for quick verification'),
                        Checkbox::make('display_contact_details')
                        ->label(' Display contact details to investors so that they can contact me directly ')
                        ->columnSpan('full'),
                        Checkbox::make('display_company_details')
                        ->label('Display company details to investors so that they can know about my company')
                        ->columnSpan('full')

                        // ...
                    ])->columns(2),
                Wizard\Step::make('Business Information')
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

                        TextInput::make('other_seller_role')->hidden(function(Get $get){

                            if($get('seller_role') != "Other"){
                                return true;
                            }

                        })->live(),



                            Select::make('seller_interest')
                            ->label('What are you interested in')
                            ->live()
                            ->options([
                                'Sale of shares' => 'Sale of shares',
                                'Sale of assets' => 'Sale of assets',
                                'Financing' => 'Financing',

                            ])->afterStateUpdated(function (Set $set, $state) {
                                $set('type_of_sale', null);
                            }),
                            Select::make('type_of_sale')
                            ->label('Type of sale')
                            ->live()
                            ->options(function(Get $get){

                                if($get('seller_interest')=='Sale of shares'){
                                    return [
                                        'Full sale of shares'=>'Full sale of shares',
                                        'Partial sale of shares'=>'Partial sale of shares',
                                    ];
                                }

                                if($get('seller_interest')=='Sale of assets'){
                                    return [
                                        'Full sale of assets'=>'Full sale of assets',
                                        'Partial sale of assets'=>'Partial sale of assets',
                                    ];
                                }

                            })->hidden(function(Get $get){

                                if($get('seller_interest') == 'Financing'){
                                    return true;
                                }
                                return false;
                            }),

                            // Full sale of shares if user selects full sale of shares

                            TextInput::make('tentative_selling_price')
                            ->label('What is the tentative selling price for the business?')
                            ->numeric()
                            ->visible(function(Get $get){

                                return $get('seller_interest') == 'Sale of shares' && $get('type_of_sale') == 'Full sale of shares';


                            }),
                            // ->hidden(function (Get $get) {
                            //     return !($get('seller_interest') == 'Sale of shares') && $get('type_of_sale') == 'full sale of shares';
                            // }),

                            Textarea::make('reason_for_sale')
                            ->label('What is the reason for the sale of the business?'),


                            // Partial sale of shares if user selects partial sale of shares

                            TextInput::make('maximum_stake')
                            ->label('What is the maximum stake that you are willing to sell?'),

                            TextInput::make('investment_amount')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('What investment amount are you seeking for this stake'),

                            Textarea::make('reason_for_investment')
                            ->label('Provide reason for investment?'),


                            // sale of assets if user selects full sale of assets or partial sale of assets

                            TextInput::make('value_of_physical_assets')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('What is the value of the physical assets you are selling?'),

                            TextInput::make('asset_selling_price')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('At what price are you selling/leasing?'),


                            Textarea::make('reason_for_selling_assets')
                            ->label('What is the reason for selling the business assets?'),




                            // Financing if user selects financing

                            TextInput::make('colateral_value')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('What is the value of the collateral you can provide?'),

                            TextInput::make('loan_amount')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('What loan amount are you seeking?'),

                            TextInput::make('yearly_interest_pay')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('What is the maximum yearly investment you can pay?'),

                            TextInput::make('years_repay_loan')
                            ->numeric()
                            ->label('In how many years will you repay the loan?'),

                            Textarea::make('reason_for_seekin_loan')
                            ->label('Reason for seeking a loan?'),

                        Select::make('business_start_date')
                            ->required()
                            ->label('When was the business established?')
                            ->options(
                                array_merge(
                                    ['Not operational yet' => 'Not operational yet'], // Static option
                                    collect(range(Carbon::now()->year, Carbon::now()->year - 50)) // Generate years dynamically
                                        ->mapWithKeys(fn ($year) => [$year => $year]) // Map the years as both the key and value
                                        ->toArray() // Convert collection to array
                    )),

                            Select::make('business_industry')
                            ->label('Select business industry')
                            ->multiple()
                            ->options([
                                'Technology' => 'Technology',
                                'Building, construction and maintenance' => 'Building, construction and maintenance',
                                'Education' => 'Education',
                                'Healthcare' => 'Healthcare',
                                'Finance and Insurance' => 'Finance and Insurance',
                                'Real Estate' => 'Real Estate',
                                'Manufacturing' => 'Manufacturing',
                                'Retail' => 'Retail',
                                'Hospitality and Tourism' => 'Hospitality and Tourism',
                                'Transportation and Logistics' => 'Transportation and Logistics',
                                'Agriculture and Farming' => 'Agriculture and Farming',
                                'Energy and Utilities' => 'Energy and Utilities',
                                'Telecommunications' => 'Telecommunications',
                                'Media and Entertainment' => 'Media and Entertainment',
                                'Legal Services' => 'Legal Services',
                                'Government and Public Services' => 'Government and Public Services',
                                'Non-profit Organizations' => 'Non-profit Organizations',
                                'Consulting and Professional Services' => 'Consulting and Professional Services',
                                'Food and Beverage' => 'Food and Beverage',
                                'Automotive' => 'Automotive',
                                'Other' => 'Other',
                            ]),

                            Fieldset::make('Where is the business located / headquartered?')
                            ->schema([
                                TextInput::make('country')
                                ->required()
                                ->label('Country'),
                            TextInput::make('city')
                                ->required()
                                ->label('City'),
                            TextInput::make('county')
                                ->required()
                                ->label('County'),
                            ])->columns(3),

                            Grid::make(3)
                            ->schema([
                                TextInput::make('number_employees')
                                ->required()
                                ->numeric()
                                ->label('How many employees does the business have?'),

                                Select::make('business_legal_entity')
                                ->label('Select business legal entity type')
                                ->options([
                                    'Sole proprietorship/sole trader' => 'Sole proprietorship/sole trader',
                                    'General partnership' => 'General partnership',
                                    'Limited liability partnership (LLP)' => 'Limited liability partnership (LLP)',
                                    'Private limited company (Ltd)' => 'Private limited company (Ltd)',
                                    'Public limited company (PLC)' => 'Public limited company (PLC)',
                                    'Limited liability company (LLC)' => 'Limited liability company (LLC)',
                                    'Corporation (Inc)' => 'Corporation (Inc)',
                                    'Non-profit organization (NPO)' => 'Non-profit organization (NPO)',
                                    'Cooperative' => 'Cooperative',
                                    'Joint venture' => 'Joint venture',
                                    'Franchise' => 'Franchise',
                                    'Trust' => 'Trust',
                                    'Association' => 'Association',
                                    'Company limited by guarantee' => 'Company limited by guarantee',
                                    'Unlimited company' => 'Unlimited company',
                                    'Other' => 'Other',
                                ])->live(),

                                TextInput::make('other_business_legal_entity')->hidden(function(Get $get){

                                    if($get('business_legal_entity') != "Other"){
                                        return true;
                                    }

                                })->live(),
                            TextInput::make('website_link')
                            ->url()
                                ->label('Link to your business website'),
                            ]),


                            Textarea::make('business_description')
                            ->required()
                            ->placeholder('Mention highlights of your business......')
                            ->label('Describe the business (Do not mention business name/information which can identify the business.)'),
                        // Textarea::make('product_services')
                        //     ->required()
                        //     ->label('List products and services of the business'),
                        // Textarea::make('business_highlights')
                        //     ->label('Mention highlights of the business including number of clients, growth rate, promoter experience, business relationships, awards, etc'),
                        Textarea::make('facility_description')
                            ->label('Describe your facility such as built-up area, number of floors, rental/lease details'),


                        // ...
                    ])->columns(2),
                Wizard\Step::make('Transactional Information')
                ->icon('heroicon-m-banknotes')
                    ->schema([
                        Shout::make('transactionalinfo')
                        ->columnSpanFull()
                        ->content("Please enter your own details here. Information entered here is not publicly displayed."),
                        Textarea::make('business_funds')
                        ->label('How is the business funded presently? Mention all debts, securities registered, equity funding, etc.'),
                    FileUpload::make('number_shareholders')
                        ->label('Upload the current list of shareholders and shareholding'),
                    TextInput::make('monthly_turnover')
                        ->numeric()
                        ->label('At present, what is your average monthly turnover?')
                        ->hint('Why is this needed?')
                        ->hintIcon('heroicon-m-question-mark-circle', tooltip: "Investors/Buyers evaluate your business proposal based on this information. It is best to communicate this information upfront instead of wasting your time and theirs."),
                    TextInput::make('yearly_turnover')
                        ->numeric()
                        ->label('Indicate turnover for the preceding year')->hint('Why is this needed?')
                        ->hintIcon('heroicon-m-question-mark-circle', tooltip: "Investors/Buyers evaluate your business proposal based on this information. It is best to communicate this information upfront instead of wasting your time and theirs."),
                    TextInput::make('profit_margin')
                    ->postfix('%')
                        ->label('What is the EBITDA / Operating Profit Margin Percentage or Last Reported Profit Margin Percentage'),
                    FileUpload::make('tangible_assets')
                        ->label('Upload the list of tangible and intangible assets of the business'),
                    FileUpload::make('liabilities')
                        ->label('Upload the list of liabilities of the business'),
                    TextInput::make('physical_assets')
                        ->label('What is the value of physical assets owned by the business that would be part of the transaction? '),
                    // Checkbox::make('interested_in_quotations')
                    //     ->label('I’m interested in receiving quotations from Advisors / Boutique Investment Banks who can manage this transaction. ')->columnSpan('full'),
                    ])->columns(2),
                    Wizard\Step::make('Documents')
                    ->icon('heroicon-m-document')
                    ->schema([

                        Shout::make('documentsinfo')
                        ->columnSpanFull()
                        ->content("Photos are an important part of your profile and are publicly displayed. Documents help us verify and approve your profile faster. Documents names entered here are publicly visible but are accessible only to introduced members."),
                        FileUpload::make('business_photos')
                        ->label('Photos of the business premises and include the following information ')->required(),
                    FileUpload::make('business_profile')
                        ->label('Business profile'),
                    FileUpload::make('kra_pin')
                        ->label('KRA pin'),
                    FileUpload::make('certificate_of_Incorporation ')
                        ->label('Certificate of Incorporation '),
                    FileUpload::make('valuation_report')
                        ->label('Valuation report'),
                    ])->columns(2),
                    Wizard\Step::make('Select a Plan')
                    ->icon('heroicon-m-cursor-arrow-ripple')
                    ->schema([
                        // Shout::make('selectaplan')
                        // ->columnSpanFull(),
                        Radio::make('active_business')
                        ->label('Select a plan')
                        ->options([
                            '12000' => 'Monthly 12,000',
                            '143000' => 'Yearly (recommended 143,999)',
                        ]),

                        Checkbox::make('finders_fee')
                        ->label("I undertake to pay 1% finder’s fee (payable post transaction) to Biasharamart and other terms of engagement")
                        ->inline(),
                    Hidden::make('verification_status')
                        ->default('Pending'),
                    ]),

            ])->skippable()->submitAction(new HtmlString('<button type="submit" style="background-color:orange; color:white; border-radius:5px; padding-top:5px; padding-bottom:5px; padding-right:10px; padding-left:10px;">Submit</button>'))
        ]);
}




    public function render()
    {
        return view('livewire.seller-components.register-seller');
    }
}
