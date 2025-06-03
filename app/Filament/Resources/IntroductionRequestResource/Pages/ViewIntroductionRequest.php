<?php

namespace App\Filament\Resources\IntroductionRequestResource\Pages;

use App\Filament\Resources\IntroductionRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Actions\Action;
use Filament\Forms;
use Filament\Notifications\Notification;

class ViewIntroductionRequest extends ViewRecord
{
    protected static string $resource = IntroductionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),

            Actions\Action::make('approve')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->visible(fn (): bool => $this->record->status === 'pending')
                ->requiresConfirmation()
                ->modalHeading('Approve Introduction Request')
                ->modalDescription('Are you sure you want to approve this introduction request? Both parties will be notified.')
                ->modalSubmitActionLabel('Approve Request')
                ->action(function () {
                    $this->record->update([
                        'status' => 'approved',
                        'reviewed_by' => auth()->id(),
                        'reviewed_at' => now(),
                        'introduction_sent_at' => now(),
                    ]);

                    Notification::make()
                        ->title('Introduction Request Approved')
                        ->body('The introduction request has been approved successfully.')
                        ->success()
                        ->send();

                    $this->refreshFormData(['status', 'reviewed_by', 'reviewed_at', 'introduction_sent_at']);
                }),

            Actions\Action::make('reject')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->visible(fn (): bool => $this->record->status === 'pending')
                ->form([
                    Forms\Components\Textarea::make('rejection_reason')
                        ->label('Rejection Reason')
                        ->required()
                        ->maxLength(1000)
                        ->placeholder('Please provide a detailed reason for rejecting this request...'),
                ])
                ->modalHeading('Reject Introduction Request')
                ->modalDescription('Please provide a reason for rejecting this introduction request.')
                ->modalSubmitActionLabel('Reject Request')
                ->action(function (array $data) {
                    $this->record->update([
                        'status' => 'rejected',
                        'rejection_reason' => $data['rejection_reason'],
                        'reviewed_by' => auth()->id(),
                        'reviewed_at' => now(),
                    ]);

                    Notification::make()
                        ->title('Introduction Request Rejected')
                        ->body('The introduction request has been rejected.')
                        ->warning()
                        ->send();

                    $this->refreshFormData(['status', 'rejection_reason', 'reviewed_by', 'reviewed_at']);
                }),

            Actions\Action::make('mark_completed')
                ->icon('heroicon-o-check-badge')
                ->color('info')
                ->visible(fn (): bool => $this->record->status === 'approved')
                ->requiresConfirmation()
                ->modalHeading('Mark as Completed')
                ->modalDescription('Mark this introduction as completed. This action cannot be undone.')
                ->modalSubmitActionLabel('Mark Completed')
                ->action(function () {
                    $this->record->update([
                        'status' => 'completed',
                    ]);

                    Notification::make()
                        ->title('Introduction Completed')
                        ->body('The introduction has been marked as completed.')
                        ->success()
                        ->send();
                }),

            Actions\Action::make('mark_paid')
                ->icon('heroicon-o-currency-dollar')
                ->color('success')
                ->visible(fn (): bool =>
                    $this->record->payment_status === 'unpaid' &&
                    in_array($this->record->status, ['approved', 'completed']))
                ->requiresConfirmation()
                ->modalHeading('Mark Payment as Received')
                ->modalDescription('Confirm that payment has been received for this introduction.')
                ->modalSubmitActionLabel('Mark as Paid')
                ->action(function () {
                    $this->record->update([
                        'payment_status' => 'paid',
                        'payment_received_at' => now(),
                    ]);

                    Notification::make()
                        ->title('Payment Received')
                        ->body('Payment has been marked as received.')
                        ->success()
                        ->send();
                }),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Request Overview')
                    ->schema([
                        Grid::make(4)
                            ->schema([
                                TextEntry::make('id')
                                    ->label('Request ID')
                                    ->badge()
                                    ->color('gray')
                                    ->prefix('#'),

                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        'completed' => 'info',
                                        default => 'gray',
                                    }),

                                TextEntry::make('payment_status')
                                    ->label('Payment Status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'unpaid' => 'warning',
                                        'paid' => 'success',
                                        'refunded' => 'danger',
                                        default => 'gray',
                                    }),

                                TextEntry::make('service_fee')
                                    ->label('Service Fee')
                                    ->money('KES')
                                    ->badge()
                                    ->color('success'),
                            ]),
                    ])
                    ->compact(),

                Section::make('Requester Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('requester.first_name')
                                    ->label('Requester Name')
                                    ->formatStateUsing(fn ($record) => $record->requester->first_name . ' ' . $record->requester->last_name)
                                    ->icon('heroicon-o-user'),

                                TextEntry::make('requester_company')
                                    ->label('Company')
                                    ->placeholder('Not provided')
                                    ->icon('heroicon-o-building-office'),

                                TextEntry::make('requester_email')
                                    ->label('Email Address')
                                    ->copyable()
                                    ->icon('heroicon-o-envelope'),

                                TextEntry::make('requester_phone')
                                    ->label('Phone Number')
                                    ->copyable()
                                    ->icon('heroicon-o-phone'),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Target Information')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('target_type')
                                    ->label('Target Type')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'business' => 'success',
                                        'investor' => 'info',
                                        default => 'gray',
                                    })
                                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),

                                TextEntry::make('target_name')
                                    ->label('Target Name')
                                    ->icon('heroicon-o-building-office-2'),

                                TextEntry::make('targetUser.first_name')
                                    ->label('Target Contact')
                                    ->formatStateUsing(fn ($record) => $record->targetUser->first_name . ' ' . $record->targetUser->last_name)
                                    ->icon('heroicon-o-user'),

                                TextEntry::make('targetUser.email')
                                    ->label('Target Email')
                                    ->copyable()
                                    ->icon('heroicon-o-envelope'),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Introduction Details')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('introduction_purpose')
                                    ->label('Purpose')
                                    ->formatStateUsing(fn (string $state): string => match ($state) {
                                        'investment_opportunity' => 'Investment Opportunity',
                                        'business_acquisition' => 'Business Acquisition',
                                        'partnership' => 'Strategic Partnership',
                                        'financing' => 'Business Financing',
                                        'asset_purchase' => 'Asset Purchase',
                                        'other' => 'Other',
                                        default => ucfirst(str_replace('_', ' ', $state)),
                                    })
                                    ->badge()
                                    ->color('info'),

                                TextEntry::make('budget_range')
                                    ->label('Budget Range')
                                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                                        'under_1m' => 'Under KES 1M',
                                        '1m_5m' => 'KES 1M - 5M',
                                        '5m_10m' => 'KES 5M - 10M',
                                        '10m_50m' => 'KES 10M - 50M',
                                        '50m_100m' => 'KES 50M - 100M',
                                        'over_100m' => 'Over KES 100M',
                                        null => 'Not specified',
                                        default => 'Not specified',
                                    })
                                    ->badge()
                                    ->color('warning'),
                            ]),

                        TextEntry::make('message')
                            ->label('Introduction Message')
                            ->columnSpanFull()
                            ->prose()
                            ->markdown(),
                    ])
                    ->collapsible(),

                Section::make('Timeline & Review Information')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Request Submitted')
                                    ->dateTime()
                                    ->icon('heroicon-o-calendar-days'),

                                TextEntry::make('reviewed_at')
                                    ->label('Reviewed At')
                                    ->dateTime()
                                    ->icon('heroicon-o-eye')
                                    ->placeholder('Not reviewed yet'),

                                TextEntry::make('introduction_sent_at')
                                    ->label('Introduction Sent')
                                    ->dateTime()
                                    ->icon('heroicon-o-paper-airplane')
                                    ->placeholder('Not sent yet'),

                                TextEntry::make('payment_received_at')
                                    ->label('Payment Received')
                                    ->dateTime()
                                    ->icon('heroicon-o-currency-dollar')
                                    ->placeholder('Payment not received'),

                                TextEntry::make('reviewer.first_name')
                                    ->label('Reviewed By')
                                    ->formatStateUsing(fn ($record) => $record->reviewer ?
                                        $record->reviewer->first_name . ' ' . $record->reviewer->last_name : 'Not reviewed')
                                    ->placeholder('Not reviewed yet')
                                    ->icon('heroicon-o-user-circle'),
                            ]),
                    ])
                    ->collapsible(),

                Section::make('Rejection Details')
                    ->schema([
                        TextEntry::make('rejection_reason')
                            ->label('Rejection Reason')
                            ->prose()
                            ->columnSpanFull()
                            ->markdown(),
                    ])
                    ->visible(fn ($record) => $record->status === 'rejected' && $record->rejection_reason)
                    ->collapsible(),
            ]);
    }
}