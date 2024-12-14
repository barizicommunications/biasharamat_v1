<?php

namespace App\Filament\Resources\InvestorProfileResource\Pages;

use Filament\Actions;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Illuminate\Support\HtmlString;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\InvestorProfileResource;

class EditInvestorProfile extends EditRecord
{
    protected static string $resource = InvestorProfileResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }



    public function form(Form $form): Form
{
    return $form->schema([
        Section::make('Investor Information')
            ->schema([
                Shout::make('investorInfo')
                    ->columnSpanFull()
                    ->content("Please enter your personal details here. The information provided will remain confidential and will not be publicly displayed."),

                Grid::make(2)->schema([
                    TextInput::make('name')
                        ->label('Contact person name')
                        ->required(),

                    TextInput::make('email')
                        ->label('Official email for quick verification')
                        ->required(),

                    TextInput::make('mobile_number')
                        ->label('Contact person mobile number')
                        ->required(),

                    Checkbox::make('display_contact_details')
                        ->label('Display contact details to investment-seeking businesses so that they can contact me directly')
                        ->columnSpan('full'),
                ]),
            ]),

        Section::make('Additional Information')
            ->schema([
                Shout::make('additionalInformation')
                    ->columnSpanFull()
                    ->content("Please provide your additional information here. The information provided will remain confidential and will not be publicly displayed."),

                Grid::make(2)->schema([
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
                ]),
            ]),

        Section::make('Your Preferences')
            ->schema([
                Shout::make('yourPreferences')
                    ->columnSpanFull()
                    ->content("Information entered here will be publicly displayed to match you with the right set of businesses."),

                Grid::make(2)->schema([
                    Select::make('interested_in')
                        ->label('You are interested in')
                        ->options([
                            'acquiring_business' => 'Acquiring / Buying a Business',
                            'investing_in_a_business' => 'Investing in a Business',
                            'lending_to_a_business' => 'Lending to a Business',
                            'buying_property_plant_machinery' => 'Buying Property / Plant / Machinery',
                            'taking_up_franchise' => 'Taking up a Franchise / Distributorship / Sales Agency',
                            'other' => 'Other (please specify)',
                        ])
                        ->live(),

                    TextInput::make('other_interest')
                        ->label('Specify other area of interest')
                        ->hidden(fn (Get $get) => $get('interested_in') !== 'other'),

                    Select::make('buyer_role')
                        ->label('You are a(n)')
                        ->options([
                            'Individual investor/buyer' => 'Individual investor/buyer',
                            'Corporate investor/buyer' => 'Corporate investor/buyer',
                            'other' => 'Other (please specify)',
                        ])
                        ->live(),

                    TextInput::make('other_buyer_role')
                        ->label('Specify role')
                        ->hidden(fn (Get $get) => $get('buyer_role') !== 'other'),

                    Select::make('buyer_interest')
                        ->label('Select industries you are interested in')
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

                    Select::make('buyer_location_interest')
                        ->label('Select locations you are interested in')
                        ->options([
                            'Nairobi' => 'Nairobi',
                            'Mombasa' => 'Mombasa',
                            'Kisumu' => 'Kisumu',
                            'Eldoret' => 'Eldoret',
                            'Nakuru' => 'Nakuru',
                        ]),

                    TextInput::make('investment_range')
                        ->label('Provide your investment range')
                        ->numeric(),
                ]),
            ]),

        Section::make('Documents & Proof')
            ->schema([
                Shout::make('documentsProof')
                    ->columnSpanFull()
                    ->content("Documents help us verify and approve your profile faster. Document names entered here are publicly visible but are accessible only to introduced members."),

                Grid::make(2)->schema([
                    FileUpload::make('business_profile')
                        ->acceptedFileTypes(['application/pdf'])
                        ->required()
                        ->label('Business profile'),

                    FileUpload::make('certificate_of_incorporation')
                        ->acceptedFileTypes(['application/pdf'])
                        ->required()
                        ->label('Certificate of Incorporation'),
                ]),
            ]),

        Section::make('Select a Plan')
            ->schema([
                Grid::make(2)->schema([
                    Radio::make('active_business')
                        ->label('Plan')
                        ->options([
                            '12000' => 'Monthly 12,000',
                            '143999' => 'Yearly (recommended 143,999)',
                        ]),

                    Checkbox::make('terms_of_engagement')
                        ->required()
                        ->label(new HtmlString('<a href="#" target="_blank" style="color:red; text-decoration:underline;">Accept our terms of agreement</a>'))
                        ->columnSpan('full'),
                ]),
            ]),
    ]);
}

}
