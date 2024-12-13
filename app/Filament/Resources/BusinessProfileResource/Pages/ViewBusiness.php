<?php

namespace App\Filament\Resources\BusinessProfileResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Models\BusinessProfile;
use Filament\Infolists\Infolist;
use Filament\Pages\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Split;
use Filament\Resources\Pages\ViewRecord;
use App\Notifications\ApplicationAccepted;
use App\Notifications\ApplicationDeclined;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use App\Filament\Resources\BusinessProfileResource;
use Filament\Infolists\Components\{TextEntry, BooleanEntry, DateEntry, ImageEntry, FileEntry, Section, Grid};

class ViewBusiness extends ViewRecord
{
    protected static string $resource = BusinessProfileResource::class;


    public function infolist(Infolist $infolist): Infolist
{
    $applicationData = is_array($this->record->application_data) ? $this->record->application_data : json_decode($this->record->application_data, true) ?? [];
    $documents = is_array($this->record->documents) ? $this->record->documents : json_decode($this->record->documents, true) ?? [];

    \Log::info('Decoded Documents:', $documents);

    return $infolist
        ->record($this->record)
        ->schema([
            Tabs::make('Details')
                ->columnSpanFull()
                ->persistTabInQueryString()
                ->tabs([
                    Tab::make('Business Details')
                        ->icon('heroicon-o-document-text')
                        ->schema([
                            Section::make('Contact Person Information')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('name')
                                        ->label('Contact Person Name')
                                        ->getStateUsing(fn() => $applicationData['name'] ?? 'N/A'),

                                    TextEntry::make('company_name')
                                        ->label('Company Name')
                                        ->getStateUsing(fn() => $applicationData['company_name'] ?? 'N/A'),

                                    TextEntry::make('mobile_number')
                                        ->label('Mobile Number')
                                        ->getStateUsing(fn() => $applicationData['mobile_number'] ?? 'N/A'),

                                    TextEntry::make('email')
                                        ->label('Email')
                                        ->getStateUsing(fn() => $applicationData['email'] ?? 'N/A'),

                                    IconEntry::make('display_contact_details')
                                        ->label('Display Contact Details')
                                        ->boolean()
                                        ->getStateUsing(fn() => $applicationData['display_contact_details'] ?? false),

                                    IconEntry::make('display_company_details')
                                        ->label('Display Company Details')
                                        ->boolean()
                                        ->getStateUsing(fn() => $applicationData['display_company_details'] ?? false),
                                ]),

                            Section::make('Business Information')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('business_industry')
                                        ->label('Business Industry')
                                        ->getStateUsing(fn() => $this->record->business_industry ?? 'N/A'),

                                    TextEntry::make('business_start_date')
                                        ->label('Business Start Date')
                                        ->getStateUsing(fn() => $this->record->business_start_date ?? 'N/A'),

                                    TextEntry::make('tentative_selling_price')
                                        ->label('Tentative Selling Price')
                                        ->getStateUsing(fn() => $this->record->tentative_selling_price ?? 'N/A'),

                                    TextEntry::make('seller_role')
                                        ->label('Seller Role')
                                        ->getStateUsing(fn() => $applicationData['seller_role'] ?? 'N/A'),

                                    TextEntry::make('seller_interest')
                                        ->label('Seller Interest')
                                        ->getStateUsing(fn() => $applicationData['seller_interest'] ?? 'N/A'),

                                    TextEntry::make('reason_for_sale')
                                        ->label('Reason for Sale')
                                        ->getStateUsing(fn() => $applicationData['reason_for_sale'] ?? 'N/A'),

                                    TextEntry::make('business_funds')
                                        ->label('Business Funds')
                                        ->getStateUsing(fn() => $applicationData['business_funds'] ?? 'N/A'),
                                ]),

                            Section::make('Subscription Details')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('active_business')
                                        ->label('Subscription Amount')
                                        ->getStateUsing(fn() => $this->record->active_business ?? 'N/A'),

                                    TextEntry::make('plan_type')
                                        ->label('Plan Type')
                                        ->getStateUsing(fn() => ucfirst($this->record->plan_type) ?? 'N/A'),

                                    IconEntry::make('finders_fee')
                                        ->label('Finders Fee')
                                        ->boolean()
                                        ->getStateUsing(fn() => $this->record->finders_fee ?? false),
                                ]),

                            Section::make('Status Information')
                                ->columns(2)
                                ->schema([
                                    TextEntry::make('status')
                                        ->label('Application Status')
                                        ->getStateUsing(fn() => ucfirst($this->record->status) ?? 'N/A'),

                                    TextEntry::make('verification_status')
                                        ->label('Verification Status')
                                        ->getStateUsing(fn() => ucfirst($this->record->verification_status) ?? 'N/A'),
                                ]),
                        ]),


                        Tab::make('Documents')
                        ->icon('heroicon-o-paper-clip')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    // Business Profile
                                    TextEntry::make('business_profile')
                                        ->label('Business Profile')
                                        ->getStateUsing(fn() => !empty($documents['business_profile']) ? 'Download Business Profile' : 'Not Uploaded')
                                        ->url(fn() => !empty($documents['business_profile']) ? asset('storage/' . $documents['business_profile']) : null)
                                        ->icon(fn() => !empty($documents['business_profile']) ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
                                        ->color(fn() => !empty($documents['business_profile']) ? 'primary' : 'danger'),

                                    // KRA PIN
                                    TextEntry::make('kra_pin')
                                        ->label('KRA PIN')
                                        ->getStateUsing(fn() => !empty($documents['kra_pin']) ? 'Download KRA PIN' : 'Not Uploaded')
                                        ->url(fn() => !empty($documents['kra_pin']) ? asset('storage/' . $documents['kra_pin']) : null)
                                        ->icon(fn() => !empty($documents['kra_pin']) ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
                                        ->color(fn() => !empty($documents['kra_pin']) ? 'primary' : 'danger'),

                                    // Certificate of Incorporation
                                    TextEntry::make('certificate_of_incorporation')
                                        ->label('Certificate of Incorporation')
                                        ->getStateUsing(fn() => !empty($documents['certificate_of_incorporation']) ? 'Download Certificate of Incorporation' : 'Not Uploaded')
                                        ->url(fn() => !empty($documents['certificate_of_incorporation']) ? asset('storage/' . $documents['certificate_of_incorporation']) : null)
                                        ->icon(fn() => !empty($documents['certificate_of_incorporation']) ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
                                        ->color(fn() => !empty($documents['certificate_of_incorporation']) ? 'primary' : 'danger'),

                                    // Valuation Report
                                    TextEntry::make('valuation_report')
                                        ->label('Valuation Report')
                                        ->getStateUsing(fn() => !empty($documents['valuation_report']) ? 'Download Valuation Report' : 'Not Uploaded')
                                        ->url(fn() => !empty($documents['valuation_report']) ? asset('storage/' . $documents['valuation_report']) : null)
                                        ->icon(fn() => !empty($documents['valuation_report']) ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
                                        ->color(fn() => !empty($documents['valuation_report']) ? 'primary' : 'danger'),

                                    // Number of Shareholders
                                    TextEntry::make('number_shareholders')
                                        ->label('Number of Shareholders')
                                        ->getStateUsing(fn() => !empty($documents['number_shareholders']) ? 'Download Number of Shareholders' : 'Not Uploaded')
                                        ->url(fn() => !empty($documents['number_shareholders']) ? asset('storage/' . $documents['number_shareholders']) : null)
                                        ->icon(fn() => !empty($documents['number_shareholders']) ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
                                        ->color(fn() => !empty($documents['number_shareholders']) ? 'primary' : 'danger'),

                                    // Tangible Assets
                                    TextEntry::make('tangible_assets')
                                        ->label('Tangible Assets')
                                        ->getStateUsing(fn() => !empty($documents['tangible_assets']) ? 'Download Tangible Assets' : 'Not Uploaded')
                                        ->url(fn() => !empty($documents['tangible_assets']) ? asset('storage/' . $documents['tangible_assets']) : null)
                                        ->icon(fn() => !empty($documents['tangible_assets']) ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
                                        ->color(fn() => !empty($documents['tangible_assets']) ? 'primary' : 'danger'),

                                    // Liabilities
                                    TextEntry::make('liabilities')
                                        ->label('Liabilities')
                                        ->getStateUsing(fn() => !empty($documents['liabilities']) ? 'Download Liabilities' : 'Not Uploaded')
                                        ->url(fn() => !empty($documents['liabilities']) ? asset('storage/' . $documents['liabilities']) : null)
                                        ->icon(fn() => !empty($documents['liabilities']) ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
                                        ->color(fn() => !empty($documents['liabilities']) ? 'primary' : 'danger'),

                                    // Business Photos
                                    TextEntry::make('business_photos')
                                        ->label('Business Photos')
                                        ->getStateUsing(fn() => !empty($documents['business_photos']) ? 'Download Business Photos' : 'Not Uploaded')
                                        ->url(fn() => !empty($documents['business_photos']) ? asset('storage/' . $documents['business_photos'][0]) : null)
                                        ->icon(fn() => !empty($documents['business_photos']) ? 'heroicon-o-document-text' : 'heroicon-o-x-circle')
                                        ->color(fn() => !empty($documents['business_photos']) ? 'primary' : 'danger'),
                                ]),
                        ]),




                ]),
        ]);
}

















    protected function getActions(): array
    {
        return [
            Action::make('Verify application')
                ->label('Verify application')
                ->color('success')
                ->icon('heroicon-o-book-open')
                ->action(function () {
                    if (auth()->user()->registration_type === "Admin") {
                        $application = BusinessProfile::find($this->record->id);

                        $application->verification_status = "Accepted";
                        $application->save();

                        $user = User::find($this->record->user_id);
                        $user->notify(new ApplicationAccepted($user));

                        return redirect()->route('filament.admin.resources.business-profiles.index');
                    }
                })
                ->hidden(fn () => in_array($this->record->verification_status, ['Accepted', 'Declined'])),

            Action::make('Decline application')
                ->label('Decline application')
                ->color('danger')
                ->icon('heroicon-o-book-open')
                ->form([
                    Textarea::make('reason_for_decline')
                        ->required()
                        ->label('Reason for Decline'),
                ])
                ->action(function (array $data) {
                    if (auth()->user()->registration_type === "Admin") {
                        $application = BusinessProfile::find($this->record->id);

                        $application->verification_status = "Declined";
                        $application->reason_for_decline = $data['reason_for_decline'];
                        $application->save();

                        $user = User::find($this->record->user_id);
                        $user->notify(new ApplicationDeclined($user, $data['reason_for_decline']));

                        return redirect()->route('filament.admin.resources.business-profiles.index');
                    }
                })
                ->hidden(fn () => in_array($this->record->verification_status, ['Accepted', 'Declined'])),
        ];
    }
}
