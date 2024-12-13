<?php

namespace App\Filament\Resources\BusinessProfileResource\Pages;

use Filament\Forms;
use Filament\Actions;
use Awcodes\Shout\Components\Shout;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\BusinessProfileResource;
use Filament\Forms\Components\{Checkbox, FileUpload, Grid, Radio, Select, Textarea, TextInput, Section, Fieldset};

class EditBusinessProfile extends EditRecord
{
    protected static string $resource = BusinessProfileResource::class;

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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        \Log::info('mutateFormDataBeforeFill - Initial data:', $data);

        // Decode 'application_data' if it's a JSON string
        if (isset($data['application_data']) && is_string($data['application_data'])) {
            $data['application_data'] = json_decode($data['application_data'], true);
        }

        // Merge 'application_data' into the main data array
        if (isset($data['application_data'])) {
            $data = array_merge($data, $data['application_data']);
            unset($data['application_data']);
        }

        // Decode 'documents' if it's a JSON string
        if (isset($data['documents']) && is_string($data['documents'])) {
            $documents = json_decode($data['documents'], true);

            // Merge the document fields into the main data array
            if (is_array($documents)) {
                $data = array_merge($data, $documents);
            }

            unset($data['documents']);
        }

        \Log::info('mutateFormDataBeforeFill - Transformed data:', $data);

        return $data;
    }




//     protected function mutateFormDataBeforeSave(array $data): array
// {
//     \Log::info('mutateFormDataBeforeSave - Initial data:', $data);

//     // Separate document fields
//     $documents = [
//         'business_profile' => $data['business_profile'] ?? null,
//         'kra_pin' => $data['kra_pin'] ?? null,
//         'certificate_of_incorporation' => $data['certificate_of_incorporation'] ?? null,
//         'valuation_report' => $data['valuation_report'] ?? null,
//         'business_photos' => $data['business_photos'] ?? [],
//         'number_shareholders' => $data['number_shareholders'] ?? null,
//         'tangible_assets' => $data['tangible_assets'] ?? null,
//         'liabilities' => $data['liabilities'] ?? null,
//     ];

//     // Collect non-document fields into application_data
//     $applicationData = collect($data)->except([
//         'business_profile',
//         'kra_pin',
//         'certificate_of_incorporation',
//         'valuation_report',
//         'business_photos',
//         'number_shareholders',
//         'tangible_assets',
//         'liabilities',
//     ])->toArray();

//     // Ensure verification status is set if not provided
//     $data['verification_status'] = $data['verification_status'] ?? 'pending';

//     // Merge the transformed data back into the original $data
//     $data['application_data'] = json_encode($applicationData);
//     $data['documents'] = json_encode($documents);

//     \Log::info('mutateFormDataBeforeSave - Final data to be saved:', $data);

//     return $data;
// }


protected function mutateFormDataBeforeSave(array $data): array
{
    \Log::info('mutateFormDataBeforeSave - Initial data:', $data);

    // Normalize file uploads to null if empty
    $documents = [
        'business_profile' => $data['business_profile'] ?? null,
        'kra_pin' => $data['kra_pin'] ?? null,
        'certificate_of_incorporation' => $data['certificate_of_incorporation'] ?? null,
        'valuation_report' => $data['valuation_report'] ?? null,
        'business_photos' => !empty($data['business_photos']) ? (is_array($data['business_photos']) ? $data['business_photos'] : [$data['business_photos']]) : [],
        'number_shareholders' => $data['number_shareholders'] ?? null,
        'tangible_assets' => $data['tangible_assets'] ?? null,
        'liabilities' => $data['liabilities'] ?? null,
    ];

    // Collect all fields that should be part of application_data
    $applicationData = [
        'name' => $data['name'] ?? null,
        'company_name' => $data['company_name'] ?? null,
        'mobile_number' => $data['mobile_number'] ?? null,
        'email' => $data['email'] ?? null,
        'display_contact_details' => $data['display_contact_details'] ?? false,
        'display_company_details' => $data['display_company_details'] ?? false,
        'seller_role' => $data['seller_role'] ?? null,
        'seller_interest' => $data['seller_interest'] ?? null,
        'tentative_selling_price' => $data['tentative_selling_price'] ?? null,
        'reason_for_sale' => $data['reason_for_sale'] ?? null,
        'business_funds' => $data['business_funds'] ?? null,
    ];

    // Ensure verification status is set if not provided
    $data['verification_status'] = $data['verification_status'] ?? 'pending';

    // Set application_data and documents as arrays
    $data['application_data'] = $applicationData;
    $data['documents'] = $documents;

    // Exclude fields that don't belong in the main table
    $data = collect($data)->except(array_merge(array_keys($applicationData), array_keys($documents)))->toArray();

    \Log::info('mutateFormDataBeforeSave - Final data to be saved:', $data);

    return $data;
}




















public function form(Forms\Form $form): Forms\Form
{
    return $form->schema([
        Section::make('Contact Person Information')
            ->schema([
                Shout::make('clientInfo')
                    ->columnSpanFull()
                    ->content("Please enter your personal details here. The information provided will remain confidential and will not be publicly displayed."),

                Grid::make(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Contact person name'),

                        TextInput::make('company_name')
                            ->required()
                            ->label('Company name'),

                        TextInput::make('mobile_number')
                            ->required()
                            ->label('Contact person mobile number'),

                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->label('Official email for quick verification'),

                        Checkbox::make('display_contact_details')
                            ->label('Display contact details to investors'),

                        Checkbox::make('display_company_details')
                            ->label('Display company details to investors'),
                    ]),
            ]),

        Section::make('Business Information')
            ->schema([
                Shout::make('businessinfo')
                    ->columnSpanFull()
                    ->content("Information entered here is displayed publicly to match you with the right set of investors and buyers."),

                Grid::make(2)
                    ->schema([
                        Select::make('seller_role')
                            ->options([
                                'Director' => 'Director',
                                'Adviser' => 'Adviser',
                                'Shareholder' => 'Shareholder',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->label('You are a(n)'),

                        TextInput::make('other_seller_role')
                            ->hidden(fn ($get) => $get('seller_role') !== 'Other')
                            ->label('Specify role'),

                        Select::make('seller_interest')
                            ->label('What are you interested in')
                            ->options([
                                'Sale of shares' => 'Sale of shares',
                                'Partial sale of shares' => 'Partial sale of shares',
                                'Sale of assets' => 'Sale of assets',
                                'Financing' => 'Financing',
                            ])
                            ->live(),

                        TextInput::make('tentative_selling_price')
                            ->label('Tentative Selling Price')
                            ->numeric()
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of shares'),

                        Textarea::make('reason_for_sale')
                            ->label('Reason for Sale')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of shares'),

                        TextInput::make('maximum_stake')
                            ->label('Maximum Stake')
                            ->numeric()
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Partial sale of shares'),

                        TextInput::make('investment_amount')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('Investment Amount')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Partial sale of shares'),

                        Textarea::make('reason_for_investment')
                            ->label('Reason for Investment')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Partial sale of shares'),

                        TextInput::make('value_of_physical_assets')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('Value of Physical Assets')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of assets'),

                        TextInput::make('asset_selling_price')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('Asset Selling Price')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of assets'),

                        Textarea::make('reason_for_selling_assets')
                            ->label('Reason for Selling Assets')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of assets'),

                        TextInput::make('colateral_value')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('Collateral Value')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Financing'),

                        TextInput::make('loan_amount')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('Loan Amount')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Financing'),

                        TextInput::make('yearly_interest_pay')
                            ->prefix('Ksh')
                            ->numeric()
                            ->label('Yearly Interest Payment')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Financing'),

                        TextInput::make('years_repay_loan')
                            ->numeric()
                            ->label('Years to Repay Loan')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Financing'),

                        Textarea::make('reason_for_seeking_loan')
                            ->label('Reason for Seeking Loan')
                            ->hidden(fn ($get) => $get('seller_interest') !== 'Financing'),
                    ]),
            ]),

        Section::make('Transactional Information')
            ->schema([
                Shout::make('transactionalinfo')
                    ->columnSpanFull()
                    ->content("Please enter your own details here. Information entered here is not publicly displayed."),

                Grid::make(2)
                    ->schema([
                        Textarea::make('business_funds')
                            ->label('How is the business funded presently?'),

                        FileUpload::make('number_shareholders')
                            ->label('Upload the current list of shareholders')
                            ->acceptedFileTypes(['application/pdf']),

                        FileUpload::make('tangible_assets')
                            ->label('Upload the list of tangible assets')
                            ->acceptedFileTypes(['application/pdf']),

                        FileUpload::make('liabilities')
                            ->label('Upload the list of liabilities')
                            ->acceptedFileTypes(['application/pdf']),
                    ]),
            ]),

        Section::make('Documents')
            ->schema([
                Grid::make(2)
                    ->schema([
                        FileUpload::make('business_photos')
                            ->label('Photos of the Business Premises')
                            ->image()
                            ->multiple(),

                        FileUpload::make('business_profile')
                            ->acceptedFileTypes(['application/pdf'])
                            ->label('Business Profile'),

                        FileUpload::make('kra_pin')
                            ->acceptedFileTypes(['application/pdf'])
                            ->label('KRA PIN'),

                        FileUpload::make('certificate_of_incorporation')
                            ->acceptedFileTypes(['application/pdf'])
                            ->label('Certificate of Incorporation'),

                        FileUpload::make('valuation_report')
                            ->acceptedFileTypes(['application/pdf'])
                            ->label('Valuation Report'),
                    ]),
            ]),

        Section::make('Select a Plan')
            ->schema([
                Grid::make(2)
                    ->schema([
                        Radio::make('active_business')
                            ->label('Select a Plan')
                            ->options([
                                '12000' => 'Monthly 12,000',
                                '143999' => 'Yearly (recommended 143,999)',
                            ]),

                        Checkbox::make('finders_fee')
                            ->label('I undertake to pay 1% finder’s fee to Biasharamart'),
                    ]),
            ]),
    ]);
}

}
