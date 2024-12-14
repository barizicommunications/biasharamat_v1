<?php

namespace App\Filament\Resources\InvestorProfileResource\Pages;

use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Tabs;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
// use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Components\ImageEntry;
use App\Filament\Resources\InvestorProfileResource;

class ViewInvestorProfile extends ViewRecord
{
    protected static string $resource = InvestorProfileResource::class;


// public function infolist(Infolist $infolist): Infolist
// {
//     return $infolist
//         ->record($this->record)
//         ->schema([
//             Tabs::make('Investor Details')
//                 ->persistTabInQueryString()
//                 ->columnSpanFull()
//                 ->tabs([
//                     // Investor Information Tab
//                     Tab::make('Investor Information')
//                         ->icon('heroicon-o-user')
//                         ->schema([
//                             Section::make('Personal Details')
//                                 ->columns(2)
//                                 ->schema([
//                                     TextEntry::make('name')
//                                         ->label('Contact Person Name'),

//                                     TextEntry::make('email')
//                                         ->label('Email'),

//                                     TextEntry::make('mobile_number')
//                                         ->label('Mobile Number'),

//                                     IconEntry::make('display_contact_details')
//                                         ->label('Display Contact Details')
//                                         ->boolean(),
//                                 ]),

//                             Section::make('Company Information')
//                                 ->columns(2)
//                                 ->schema([
//                                     TextEntry::make('company_name')
//                                         ->label('Company Name'),

//                                     TextEntry::make('current_location')
//                                         ->label('Current Location'),

//                                     TextEntry::make('your_designation')
//                                         ->label('Designation'),

//                                     TextEntry::make('company_industry')
//                                         ->label('Company Industry'),
//                                 ]),
//                         ]),

//                     // Preferences Tab
//                     Tab::make('Preferences')
//                         ->icon('heroicon-o-cog')
//                         ->schema([
//                             Section::make('Investment Preferences')
//                                 ->columns(2)
//                                 ->schema([
//                                     TextEntry::make('interested_in')
//                                         ->label('Interested In'),

//                                     TextEntry::make('other_interest')
//                                         ->label('Other Interest'),

//                                     TextEntry::make('buyer_role')
//                                         ->label('Buyer Role'),

//                                     TextEntry::make('other_buyer_role')
//                                         ->label('Other Buyer Role'),

//                                     TextEntry::make('buyer_interest')
//                                         ->label('Industries of Interest'),

//                                     TextEntry::make('buyer_location_interest')
//                                         ->label('Location Interest'),

//                                     TextEntry::make('investment_range')
//                                         ->label('Investment Range'),
//                                 ]),
//                         ]),

//                     // Documents Tab
//                     Tab::make('Documents')
//                         ->icon('heroicon-o-paper-clip')
//                         ->schema([
//                             Grid::make(2)
//                                 ->schema([
//                                 TextEntry::make('business_profile')
//                                     ->label('Business Profile')
//                                     ->getStateUsing(fn() => $this->record->business_profile ? 'Download Business Profile' : 'Not Uploaded')
//                                     ->url(fn() => $this->record->business_profile ? asset('storage/' . $this->record->business_profile) : null)
//                                     ->icon(fn() => $this->record->business_profile ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
//                                     ->color(fn() => $this->record->business_profile ? 'primary' : 'danger')
//                                     ->openUrlInNewTab(),

//                                 TextEntry::make('certificate_of_incorporation')
//                                     ->label('Certificate of Incorporation')
//                                     ->getStateUsing(fn() => $this->record->certificate_of_incorporation ? 'Download Certificate of Incorporation' : 'Not Uploaded')
//                                     ->url(fn() => $this->record->certificate_of_incorporation ? asset('storage/' . $this->record->certificate_of_incorporation) : null)
//                                     ->icon(fn() => $this->record->certificate_of_incorporation ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
//                                     ->color(fn() => $this->record->certificate_of_incorporation ? 'primary' : 'danger')
//                                     ->openUrlInNewTab(),
//                                 ]),
//                         ]),

//                     // Subscription Details Tab
//                     Tab::make('Subscription Details')
//                         ->icon('heroicon-o-currency-dollar')
//                         ->schema([
//                             Section::make('Plan Details')
//                                 ->columns(2)
//                                 ->schema([
//                                     TextEntry::make('active_business')
//                                         ->label('Subscription Amount'),

//                                     TextEntry::make('plan_type')
//                                         ->label('Plan Type'),

//                                     IconEntry::make('terms_of_engagement')
//                                         ->label('Terms of Engagement')
//                                         ->boolean(),
//                                 ]),
//                         ]),
//                 ]),
//         ]);
// }

public function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->record($this->record)
        ->schema([
            Tabs::make('Investor Details')
                ->columnSpanFull()
                ->persistTabInQueryString()
                ->tabs([
                    // Investor Information Tab
                    Tab::make('Investor Information')
                        ->icon('heroicon-o-user')
                        ->schema([
                            Section::make('Personal Details')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('name')
                                        ->label('Contact Person Name'),

                                    TextEntry::make('email')
                                        ->label('Email'),

                                    TextEntry::make('mobile_number')
                                        ->label('Mobile Number'),

                                    IconEntry::make('display_contact_details')
                                        ->label('Display Contact Details')
                                        ->boolean(),
                                ]),

                            Section::make('Company Information')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('company_name')
                                        ->label('Company Name'),

                                    TextEntry::make('current_location')
                                        ->label('Current Location'),

                                    TextEntry::make('your_designation')
                                        ->label('Designation'),

                                    TextEntry::make('company_industry')
                                        ->label('Company Industry'),
                                ]),
                        ]),

                    // Preferences Tab
                    Tab::make('Preferences')
                        ->icon('heroicon-o-cog')
                        ->schema([
                            Section::make('Investment Preferences')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('interested_in')
                                        ->label('Interested In'),

                                    TextEntry::make('other_interest')
                                        ->label('Other Interest'),

                                    TextEntry::make('buyer_role')
                                        ->label('Buyer Role'),

                                    TextEntry::make('other_buyer_role')
                                        ->label('Other Buyer Role'),

                                    TextEntry::make('buyer_interest')
                                        ->label('Industries of Interest'),

                                    TextEntry::make('buyer_location_interest')
                                        ->label('Location Interest'),

                                    TextEntry::make('investment_range')
                                        ->label('Investment Range'),
                                ]),
                        ]),

                    // Documents Tab
                    Tab::make('Documents')
                        ->icon('heroicon-o-paper-clip')
                        ->schema([
                            Grid::make(1)
                                ->schema([
                                    Section::make('Business Profile')
                                        ->hidden(fn () => ! $this->record->business_profile)
                                        ->schema([
                                            ViewEntry::make('business_profile_viewer')
                                            ->view('filament.infolist.entries.document-viewer')
                                            ->viewData([
                                                'url' => asset('storage/' . $this->record->business_profile),
                                                'label' => 'Business Profile',
                                            ]),

                                        ]),

                                    Section::make('Certificate of Incorporation')
                                        ->hidden(fn () => ! $this->record->certificate_of_incorporation)
                                        ->schema([
                                            ViewEntry::make('certificate_viewer')
                                            ->view('filament.infolist.entries.document-viewer')
                                            ->viewData([
                                                'url' => asset('storage/' . $this->record->certificate_of_incorporation),
                                                'label' => 'Certificate of Incorporation',
                                            ]),

                                        ]),
                                ]),
                        ]),

                    // Subscription Details Tab
                    Tab::make('Subscription Details')
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            Section::make('Plan Details')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('active_business')
                                        ->label('Subscription Amount'),

                                    TextEntry::make('plan_type')
                                        ->label('Plan Type'),

                                    IconEntry::make('terms_of_engagement')
                                        ->label('Terms of Engagement')
                                        ->boolean(),
                                ]),
                        ]),
                ]),
        ]);
}

}
