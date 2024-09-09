<?php

namespace App\Livewire\SellerComponents;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
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
                ->description('The information provided will remain confidential and will not be publicly displayed.')
                    ->schema([

                        TextInput::make('name')
                        ->required(),
                        TextInput::make('company_name')
                        ->required(),

                        // ...
                    ])->columns(2),
                Wizard\Step::make('Delivery')
                    ->schema([
                        // ...
                    ]),
                Wizard\Step::make('Billing')
                    ->schema([
                        // ...
                    ]),
            ])
        ]);
}
    
    public function render()
    {
        return view('livewire.seller-components.register-seller');
    }
}
