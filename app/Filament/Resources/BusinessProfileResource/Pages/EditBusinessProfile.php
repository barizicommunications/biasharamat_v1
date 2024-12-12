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
                                ->label('What is the tentative selling price for the business?')
                                ->numeric()
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of shares'),

                            Textarea::make('reason_for_sale')
                                ->label('What is the reason for the sale of the business?')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of shares'),

                            TextInput::make('maximum_stake')
                                ->label('What is the maximum stake that you are willing to sell?')
                                ->numeric()
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Partial sale of shares'),

                            TextInput::make('investment_amount')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What investment amount are you seeking for this stake')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Partial sale of shares'),

                            Textarea::make('reason_for_investment')
                                ->label('Provide reason for investment')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Partial sale of shares'),

                            TextInput::make('value_of_physical_assets')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What is the value of the physical assets you are selling?')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of assets'),

                            TextInput::make('asset_selling_price')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('At what price are you selling/leasing?')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of assets'),

                            Textarea::make('reason_for_selling_assets')
                                ->label('What is the reason for selling the business assets?')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Sale of assets'),

                            TextInput::make('colateral_value')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What is the value of the collateral you can provide?')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Financing'),

                            TextInput::make('loan_amount')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What loan amount are you seeking?')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Financing'),

                            TextInput::make('yearly_interest_pay')
                                ->prefix('Ksh')
                                ->numeric()
                                ->label('What is the maximum yearly investment you can pay?')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Financing'),

                            TextInput::make('years_repay_loan')
                                ->numeric()
                                ->label('In how many years will you repay the loan?')
                                ->hidden(fn ($get) => $get('seller_interest') !== 'Financing'),

                            Textarea::make('reason_for_seeking_loan')
                                ->label('Reason for seeking a loan')
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
                        ]),
                ]),

            Section::make('Documents')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            FileUpload::make('business_photos')
                                ->label('Photos of the business premises')
                                ->required()
                                ->image()
                                ->multiple(),

                            FileUpload::make('business_profile')
                                ->acceptedFileTypes(['application/pdf'])
                                ->required()
                                ->label('Business profile'),
                        ]),
                ]),

            Section::make('Select a Plan')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Radio::make('active_business')
                                ->label('Select a plan')
                                ->options([
                                    '12000' => 'Monthly 12,000',
                                    '143999' => 'Yearly (recommended 143,999)',
                                ]),

                            Checkbox::make('finders_fee')
                                ->label("I undertake to pay 1% finder’s fee to Biasharamart"),
                        ]),
                ]),
        ]);
    }
}
