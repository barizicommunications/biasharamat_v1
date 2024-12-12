<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\BusinessProfile;
use Filament\Resources\Resource;
use Illuminate\Support\HtmlString;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BusinessProfileResource\Pages;
use App\Filament\Resources\BusinessProfileResource\RelationManagers;

class BusinessProfileResource extends Resource
{
    protected static ?string $model = BusinessProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static ?string $navigationGroup = 'Manage user profiles';
    protected static ?int $navigationSort= 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Wizard::make([
                //     Wizard\Step::make('Contact Person Information')
                //     ->icon('heroicon-m-user')
                //     ->completedIcon('heroicon-o-hand-thumb-up')
                //         ->schema([

                //             Shout::make('clientInfo')
                //             ->columnSpanFull()
                //             ->content("Please enter your personal details here. The information provided will remain confidential and will not be publicly displayed."),

                //             TextInput::make('name')
                //             ->required()
                //             // ->afterStateUpdated(fn (Set $set, $state) => $set('name', $state))
                //             ->label('Contact person name'),
                //             // ->afterStateUpdated(fn ($state) => $this->validateOnly('name')),
                //         TextInput::make('company_name')
                //         ->hint('Why is this needed?')
                //         ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'This information is required for our verification process. Biasharamat may ask for supporting documentation without which we are unable to activate your profile. This information is never disclosed to anyone without your permission.')
                //             ->required()
                //             ->label('Company name'),
                //         TextInput::make('mobile_number')
                //         // ->tel()
                //         // ->telRegex('/^(0|\+254)7[0-9]{7}$/')
                //         ->hint('Why is this needed?')
                //         ->hintIcon('heroicon-m-question-mark-circle', tooltip: "We'll use this to contact you for verification and activation of your account. We will never share your number with telemarketers.")
                //             ->required()
                //             ->label('Contact person mobile number'),
                //         TextInput::make('email')
                //             ->email()
                //             ->required()
                //             // ->afterStateUpdated(fn (Set $set, $state) => $set('email', $state))
                //             ->hint('Why is this needed?')
                //         ->hintIcon('heroicon-m-question-mark-circle', tooltip: "Enter a valid official email address to ensure your profile is prioritized and verified faster. Please note that this email address is used only for verification purposes and all email communications will be sent only to your registered email address.")
                //             ->label('Official email for quick verification'),
                //             Checkbox::make('display_contact_details')
                //             ->label(' Display contact details to investors so that they can contact me directly ')
                //             ->columnSpan('full'),
                //             Checkbox::make('display_company_details')
                //             ->label('Display company details to investors so that they can know about my company')
                //             ->columnSpan('full')

                //             // ...
                //         ])->columns(2),
                //     Wizard\Step::make('Business Information')
                //     ->completedIcon('heroicon-o-hand-thumb-up')
                //     ->icon('heroicon-m-briefcase')
                //         ->schema([

                //             Shout::make('businessinfo')
                //             ->columnSpanFull()
                //             ->content("Information entered here is displayed publicly to match you with the right set of investors and buyers. Do not mention business name/information which can identify the business."),


                //             Select::make('seller_role')
                //                 ->options([
                //                     'Director' => 'Director',
                //                     'Adviser' => 'Adviser',
                //                     'Shareholder' => 'Shareholder',
                //                     'Other' => 'Other',
                //                 ])
                //                 ->required()
                //                 ->live()
                //                 ->label('You are a(n)')
                //                 ->afterStateUpdated(function (Set $set, $state) {
                //                     $set('other_seller_role', null);
                //                 }),

                //             TextInput::make('other_seller_role')->hidden(function(Get $get){

                //                 if($get('seller_role') != "Other"){
                //                     return true;
                //                 }

                //             })->label('Specify role'),

                //                 Select::make('seller_interest')
                //                 ->label('What are you interested in')
                //                 ->live()
                //                 ->options([
                //                    'Sale of shares'=>'Sale of shares',
                //                     'Partial sale of shares'=>'Partial sale of shares',
                //                     'Sale of assets'=>'Sale of assets',
                //                     'Financing' => 'Financing',

                //                 ]),


                //                 TextInput::make('tentative_selling_price')
                //                 ->label('What is the tentative selling price for the business?')
                //                 ->numeric()
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Sale of shares');

                //                 }),


                //                 Textarea::make('reason_for_sale')
                //                 ->label('What is the reason for the sale of the business?')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Sale of shares');

                //                 }),


                //                 // Partial sale of shares if user selects partial sale of shares

                //                 TextInput::make('maximum_stake')
                //                 ->label('What is the maximum stake that you are willing to sell?')
                //                 ->numeric()
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Partial sale of shares');

                //                 }),

                //                 TextInput::make('investment_amount')
                //                 ->prefix('Ksh')
                //                 ->numeric()
                //                 ->label('What investment amount are you seeking for this stake')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Partial sale of shares');

                //                 }),

                //                 Textarea::make('reason_for_investment')
                //                 ->label('Provide reason for investment?')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Partial sale of shares');

                //                 }),


                //                 // sale of assets if user selects full sale of assets or partial sale of assets

                //                 TextInput::make('value_of_physical_assets')
                //                 ->prefix('Ksh')
                //                 ->numeric()
                //                 ->label('What is the value of the physical assets you are selling?')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Sale of assets');

                //                 }),

                //                 TextInput::make('asset_selling_price')
                //                 ->prefix('Ksh')
                //                 ->numeric()
                //                 ->label('At what price are you selling/leasing?')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Sale of assets');

                //                 }),


                //                 Textarea::make('reason_for_selling_assets')
                //                 ->label('What is the reason for selling the business assets?')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Sale of assets');

                //                 }),




                //                 // Financing if user selects financing

                //                 TextInput::make('colateral_value')
                //                 ->prefix('Ksh')
                //                 ->numeric()
                //                 ->label('What is the value of the collateral you can provide?')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Financing');

                //                 }),

                //                 TextInput::make('loan_amount')
                //                 ->prefix('Ksh')
                //                 ->numeric()
                //                 ->label('What loan amount are you seeking?')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Financing');

                //                 }),

                //                 TextInput::make('yearly_interest_pay')
                //                 ->prefix('Ksh')
                //                 ->numeric()
                //                 ->label('What is the maximum yearly investment you can pay?')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Financing');

                //                 }),

                //                 TextInput::make('years_repay_loan')
                //                 ->numeric()
                //                 ->label('In how many years will you repay the loan?')
                //                 ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Financing');

                //                 }),

                //                 Textarea::make('reason_for_seeking_loan')
                //                 ->label('Reason for seeking a loan?')  ->hidden(function (Get $get) {

                //                     return !($get('seller_interest') === 'Financing');

                //                 }),

                //                 Select::make('business_start_date')
                //                 ->required()
                //                 ->label('When was the business established?')
                //                 ->options(array_merge(
                //                     ['Not operational yet' => 'Not operational yet'],
                //                     array_combine(
                //                         range(date('Y'), date('Y') - 50),
                //                         range(date('Y'), date('Y') - 50)
                //                     )
                //                 )),



                //                 Select::make('business_industry')
                //                 ->label('Select business industry')
                //                 ->live()
                //                 ->options(function () {
                //                     // Load and decode the JSON file
                //                     $data = json_decode(Storage::disk('local')->get('data/business_industries.json'), true);

                //                     // Return the industries as options
                //                     return $data;
                //                 }),
                //                 TextInput::make('other_business_industry')->hidden(function(Get $get){

                //                     if($get('business_industry') != "Other"){
                //                         return true;
                //                     }

                //                 })->label('Specify business industry'),

                //                 Fieldset::make('Where is the business located / headquartered?')
                //                 ->schema([
                //                     Select::make('country')
                //                     ->label('Country')
                //                     ->required()
                //                     ->live()
                //                     ->options(function () {
                //                         $data = collect(json_decode(Storage::disk('local')->get('data/countries.json'), true));
                //                         return $data->keys()->mapWithKeys(fn ($country) => [$country => $country])->toArray();
                //                     })
                //                     ->afterStateUpdated(function (Set $set, $state) {
                //                         if ($state !== $this->country) {
                //                             $set('city', null); // Reset city only if the country changes
                //                         }
                //                     }),

                //                     Select::make('city')
                //                     ->label('City')
                //                     ->required()
                //                     ->live()
                //                     ->options(function (callable $get) {
                //                         $country = $get('country');

                //                         if ($country) {
                //                             // Load cities for the selected country
                //                             $data = collect(json_decode(Storage::disk('local')->get('data/countries.json'), true));
                //                             return $data->get($country, []);
                //                         }

                //                         return []; // Return empty if no country is selected
                //                     })
                //                     ->afterStateUpdated(function (Set $set, $state) {
                //                         $set('city', $state); // Ensure city state is updated
                //                     }),

                //                 TextInput::make('town')
                //                     ->required()
                //                     ->label('Town/Location'),
                //                 ])->columns(3),

                //                 Grid::make(3)
                //                 ->schema([
                //                     TextInput::make('number_employees')
                //                     ->required()
                //                     ->numeric()
                //                     ->label('How many employees does the business have?'),

                //                     Select::make('business_legal_entity')
                //                     ->label('Select business legal entity type')
                //                     ->live()
                //                     ->options(function () {
                //                         // Load and decode the JSON file
                //                         $data = json_decode(Storage::disk('local')->get('data/business_legal_entities.json'), true);

                //                         // Return the entities as options
                //                         return $data;
                //                     }),

                //                     TextInput::make('other_business_legal_entity')->hidden(function(Get $get){

                //                         if($get('business_legal_entity') != "Other"){
                //                             return true;
                //                         }

                //                     })->live()
                //                     ->label('Specify business legal entity'),
                //                 TextInput::make('website_link')
                //                 ->url()
                //                     ->label('Link to your business website'),
                //                 ]),


                //                 Textarea::make('business_description')
                //                 ->required()
                //                 ->placeholder('Share what your business does, its industry, and key activities.')
                //                 ->label('Tell us about your business'),
                //             Textarea::make('facility_description')
                //             ->label('Describe Facility')
                //                 ->label('Describe your facility such as built-up area, number of floors, Indicate whether rental or lease.'),


                //             // ...
                //         ])->columns(2),
                //     Wizard\Step::make('Transactional Information')
                //     ->icon('heroicon-m-banknotes')
                //     ->completedIcon('heroicon-o-hand-thumb-up')
                //         ->schema([
                //             Shout::make('transactionalinfo')
                //             ->columnSpanFull()
                //             ->content("Please enter your own details here. Information entered here is not publicly displayed."),
                //             Textarea::make('business_funds')
                //             ->label('How is the business funded presently? Mention all debts, securities registered, equity funding, etc.'),
                //         FileUpload::make('number_shareholders')
                //             ->label('Upload the current list of shareholders and shareholding')
                //             ->required()
                //             ->acceptedFileTypes(['application/pdf']),
                //         TextInput::make('monthly_turnover')
                //             ->numeric()
                //             ->label('At present, what is your average monthly turnover?')
                //             ->hint('Why is this needed?')
                //             ->hintIcon('heroicon-m-question-mark-circle', tooltip: "Investors/Buyers evaluate your business proposal based on this information. It is best to communicate this information upfront instead of wasting your time and theirs."),
                //         TextInput::make('yearly_turnover')
                //             ->numeric()
                //             ->label('Indicate turnover for the preceding year')->hint('Why is this needed?')
                //             ->hintIcon('heroicon-m-question-mark-circle', tooltip: "Investors/Buyers evaluate your business proposal based on this information. It is best to communicate this information upfront instead of wasting your time and theirs."),
                //         TextInput::make('profit_margin')
                //         ->numeric()
                //         ->postfix('%')
                //             ->label('What is the EBITDA / Operating Profit Margin Percentage or Last Reported Profit Margin Percentage'),
                //         FileUpload::make('tangible_assets')
                //             ->label('Upload the list of tangible and intangible assets of the business')
                //             ->required()
                //             ->acceptedFileTypes(['application/pdf']),
                //         FileUpload::make('liabilities')
                //             ->label('Upload the list of liabilities of the business')
                //             ->required()
                //             ->acceptedFileTypes(['application/pdf']),
                //         TextInput::make('physical_assets')
                //         ->numeric()
                //             ->label('What is the value of physical assets owned by the business that would be part of the transaction? '),
                //         ])->columns(2),
                //         Wizard\Step::make('Documents')
                //         ->icon('heroicon-m-document')
                //         ->completedIcon('heroicon-o-hand-thumb-up')
                //         ->schema([

                //             Shout::make('documentsinfo')
                //             ->columnSpanFull()
                //             ->content("Photos are an important part of your profile and are publicly displayed. Documents help us verify and approve your profile faster. Documents names entered here are publicly visible but are accessible only to introduced members."),
                //             FileUpload::make('business_photos')
                //             ->required()
                //             ->label('Photos of the business premises(Min: 5, Max: 7, File type .jpeg,.png .webp to be uploaded below 5MB )')->required()
                //             ->image()
                //             ->downloadable()
                //             ->multiple()
                //             ,
                //         FileUpload::make('business_profile')
                //             ->acceptedFileTypes(['application/pdf'])
                //             ->required()
                //             ->label('Business profile'),
                //         FileUpload::make('kra_pin')
                //             ->acceptedFileTypes(['application/pdf'])
                //             ->required()
                //             ->label('KRA pin'),
                //         FileUpload::make('certificate_of_incorporation')
                //            ->acceptedFileTypes(['application/pdf'])
                //            ->required()
                //             ->label('Certificate of Incorporation '),
                //         FileUpload::make('valuation_report')
                //             ->acceptedFileTypes(['application/pdf'])
                //             ->required()
                //             ->label('Valuation report'),
                //         ])->columns(2),


                //         Wizard\Step::make('Select a Plan')
                //         ->icon('heroicon-m-cursor-arrow-ripple')
                //         ->completedIcon('heroicon-o-hand-thumb-up')
                //         ->schema([
                //             // Shout::make('selectaplan')
                //             // ->columnSpanFull(),
                //             Radio::make('active_business')
                //             ->label('Select a plan')
                //             ->options([
                //                 '12000' =>'Monthly 12,000',
                //                 '143999' => 'Yearly (recommended 143,999)',
                //             ]),

                //             Checkbox::make('finders_fee')
                //             ->label("I undertake to pay 1% finder’s fee (payable post transaction) to Biasharamart and other terms of engagement")
                //             ->inline(),
                //             Hidden::make('user_id')
                //             ->default(auth()->user()->id),
                //         Hidden::make('verification_status')
                //             ->default('Pending'),
                //         ]),



                // ])
                // ->persistStepInQueryString()
                // // ->skippable()
                // // ->startOnStep(2)
                // ->submitAction(new HtmlString('<button type="submit" style="background-color:#c75126; color:white; border-radius:5px; padding-top:5px; padding-bottom:5px; padding-right:10px; padding-left:10px;">Submit</button>'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('application_data.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('application_data.company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('application_data.mobile_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),

                Tables\Columns\TextColumn::make('seller_role'),


                Tables\Columns\TextColumn::make('verification_status')
                    ->searchable(),

                // Tables\Columns\TextColumn::make('active_business')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinessProfiles::route('/'),
            'create' => Pages\CreateBusinessProfile::route('/create'),
            'view' => Pages\ViewBusiness::route('/{record}'),
            'edit' => Pages\EditBusinessProfile::route('/{record}/edit'),
        ];
    }
}
