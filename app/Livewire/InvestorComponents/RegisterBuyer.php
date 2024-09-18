<?php

namespace App\Livewire\InvestorComponents;

use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Filament\Forms\Form;
use Livewire\WithFileUploads;
use Illuminate\Support\HtmlString;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Concerns\InteractsWithForms;
use Yepsua\Filament\Forms\Components\RangeSlider;

class RegisterBuyer extends Component implements HasForms
{

    use InteractsWithForms , WithFileUploads;


    public $name;
    public $email;
    public $mobile_number;
    public $display_contact_details;

    public $interested_in;
    public $other_interest;
    public $other_buyer_role;
    public $buyer_role;
    public $buyer_interest;
    public $buyer_location_interest;
    public $investment_range;
    public $current_location;
    public $company_name;
    public $linkedin_profile;
    public $website_link;
    public $business_factors;
    public $about_company;
    public $corporate_profile;
    public $company_logo;
    public $proof_of_business;
    public $active_business;
    public $terms_of_engagement;


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                Wizard\Step::make('Investor information')
                ->icon('heroicon-m-user')
                ->completedIcon('heroicon-o-hand-thumb-up')
                    ->schema([

                        Shout::make('investorInfo')
                        ->columnSpanFull()
                        ->content("Please enter your personal details here. The information provided will remain confidential and will not be publicly displayed."),

                        TextInput::make('name')
                        ->label('Your name')
                        ->required(),

                        TextInput::make('email')
                        ->label('Official email for quick verification')
                        ->required(),

                        TextInput::make('mobile_number')
                        ->label('Your mobile number')
                        ->required(),

                        Checkbox::make('display_contact_details')
                        ->label('Display contact details to investment-seeking businesses so that they can contact me directly')

                    ])->columns(2),
                    Wizard\Step::make('Additional information')
                    ->icon('heroicon-m-clipboard-document-check')
                    ->completedIcon('heroicon-o-hand-thumb-up')
                        ->schema([

                            Shout::make('additionalInformation')
                            ->columnSpanFull()
                            ->content("Please provide your additional information here. The information provided will remain confidential and will not be publicly displayed."),



                        TextInput::make('company_name')
                            ->label('Name of company'),

                            TextInput::make('current_location')
                            ->label('Your current location'),

                            TextInput::make('your_designation')
                            ->label('Your current designation'),

                            Select::make('company_industry')
                            ->label('Select your company industry')
                            ->options([
                                'education' => 'Education',
                                'technology' => 'Technology',
                                'building_construction_and_maintenance' => 'Building Construction and Maintenance',
                                'agriculture' => 'Agriculture',
                                'healthcare' => 'Healthcare',
                                'manufacturing' => 'Manufacturing',
                                'retail' => 'Retail',
                                'hospitality' => 'Hospitality',
                                'finance' => 'Finance',
                                'transportation' => 'Transportation',
                                'media_and_entertainment' => 'Media and Entertainment',
                                'professional_services' => 'Professional Services',
                                'government' => 'Government',
                                'renewable_energy' => 'Renewable Energy',
                                'e_commerce' => 'E-commerce',
                                'artificial_intelligence' => 'Artificial Intelligence',
                                'biotechnology' => 'Biotechnology'
                            ]),

                        TextInput::make('linkedin_profile')
                            ->label('Company LinkedIn profile. Private')
                            ->type('url'),

                        TextInput::make('website_link')
                            ->label('Link to company website')
                            ->type('url'),

                            Textarea::make('about_company')
                                ->label('About the investor'),

                            Textarea::make('business_factors')
                            ->label('Factors the company looks for in a business'),

    


                        ])->columns(2),
                    Wizard\Step::make('Your preferences')
                    ->icon('heroicon-m-shield-check')
                    ->completedIcon('heroicon-o-hand-thumb-up')
                        ->schema([

                            Shout::make('yourPreferences')
                            ->columnSpanFull()
                            ->content("Information entered here will be publicly displayed to match you with the right set of businesses."),


                            Select::make('interested_in')
                            ->label('You are interested in')
                            ->options([
                                'acquiring_business' => 'Acquiring / Buying a Business',
                                'investing_in_a_business' => 'Investing in a Business',
                                'lending_to_a_business' => 'Lending to a Business',
                                'buying_property_plant_machinery' => 'Buying Property / Plant / Machinery',
                                'taking_up_franchise' => 'Taking up a Franchise / Distributorship / Sales Agency',
                                'other' => 'Other (please specify)',
                            ])->live(),

                            TextInput::make('other_interest')
                            ->label('Other area of interest')
                            ->hidden(function(Get $get){

                                return !($get('interested_in') === 'other');

                            }),

                        Select::make('buyer_role')
                            ->label('Your are a(n)')
                            ->live()
                            ->options([
                                'Individual investor/buyer'=> 'Individual investor/buyer',
                                'Corporate investor/buyer' => 'Corporate investor/buyer',
                                'other' => 'Other (please specify)',
                            ]),

                            TextInput::make('other_buyer_role')
                            ->label('Specify role')
                            ->hidden(function(Get $get){

                                return !($get('buyer_role') === 'other');

                            }),


                        Select::make('buyer_interest')
                            ->label('Select industries you are interested in')
                            ->multiple()
                            ->options([
                                'education' => 'Education',
                                'technology' => 'Technology',
                                'building_construction_and_maintenance' => 'Building Construction and Maintenance',
                                'agriculture' => 'Agriculture',
                                'healthcare' => 'Healthcare',
                                'manufacturing' => 'Manufacturing',
                                'retail' => 'Retail',
                                'hospitality' => 'Hospitality',
                                'finance' => 'Finance',
                                'transportation' => 'Transportation',
                                'media_and_entertainment' => 'Media and Entertainment',
                                'professional_services' => 'Professional Services',
                                'government' => 'Government',
                                'renewable_energy' => 'Renewable Energy',
                                'e_commerce' => 'E-commerce',
                                'artificial_intelligence' => 'Artificial Intelligence',
                                'biotechnology' => 'Biotechnology'
                            ])->maxItems(2),

                        Select::make('buyer_location_interest')
                            ->label('Select locations you are interested in')
                            ->multiple()
                            ->options([
                                'Nairobi',
                                'Mombasa',
                                'Kisumu',
                                'Eldoret',
                                'Nakuru',
                            ]),

                        TextInput::make('investment_range')
                            ->label('Provide your investment range')
                            ,




                        ])->columns(2),



                            Wizard\Step::make('Documents & proof')
                            ->icon('heroicon-m-document')
                            ->completedIcon('heroicon-o-hand-thumb-up')
                                ->schema([

                                    Shout::make('documentsProof')
                                    ->columnSpanFull()
                                    ->content("Documents help us verify and approve your profile faster. Document names entered here are publicly visible but are accessible only to introduced members."),

                                    FileUpload::make('business_profile')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->required()
                                    ->label('Business profile'),

                                    FileUpload::make('certificate_of_incorporation')
                                    ->acceptedFileTypes(['application/pdf'])
                                    ->required()
                                     ->label('Certificate of Incorporation '),


                                ])->columns(2),

                                Wizard\Step::make('Select a plan')
                                ->icon('heroicon-m-cursor-arrow-ripple')
                                ->completedIcon('heroicon-o-hand-thumb-up')
                                    ->schema([

                                        Radio::make('active_business')
                                        ->label('Plan')
                                        ->options([
                                            'active_business' => 'Active Plan',
                                            'premium_plan' => 'Premium Plan (Recommended)',
                                            'yearly_plan' => 'Yearly Plan',
                                        ])
                                        ->columns(3),

                                    Checkbox::make('terms_of_engagement')
                                        ->label(new HtmlString('<a href="#" target="_blank" style="color:red; text-decoration:underline;">Accept our terms of agreement</a>'))
                                        ->columnSpan('full'),





                                    ])->columns(2),

                ])->skippable()

            ]);
    }


    public function render()
    {
        return view('livewire.investor-components.register-buyer');
    }
}
