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
                Wizard\Step::make('Order')
                    ->schema([
                        // ...
                    ]),
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
