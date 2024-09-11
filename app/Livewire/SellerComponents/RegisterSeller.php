<?php

namespace App\Livewire\SellerComponents;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class RegisterSeller extends Component implements HasForms
{
    use InteractsWithForms;


    public function form(Form $form): Form
{
    return $form
        ->schema([
            Wizard::make([
                Wizard\Step::make('Client Information')
                ->description('Client info')
                    ->schema([

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
                    ]),
                Wizard\Step::make('Billing')
                    ->schema([
                        // ...
                    ]),
            ])->skippable()
        ]);
}

    public function render()
    {
        return view('livewire.seller-components.register-seller');
    }
}
