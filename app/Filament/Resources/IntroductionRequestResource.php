<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IntroductionRequestResource\Pages;
use App\Models\IntroductionRequest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class IntroductionRequestResource extends Resource
{
    protected static ?string $model = IntroductionRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Introduction Management';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Introduction Requests';

    public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\Section::make('Request Status')
                ->schema([
                    Forms\Components\Select::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                            'completed' => 'Completed',
                        ])
                        ->required()
                        ->live()
                        ->default('pending'),

                    Forms\Components\Select::make('payment_status')
                        ->options([
                            'unpaid' => 'Unpaid',
                            'paid' => 'Paid',
                            'refunded' => 'Refunded',
                        ])
                        ->required()
                        ->default('unpaid'),
                ])
                ->columns(2),

            Forms\Components\Section::make('Review Information')
                ->schema([
                    Forms\Components\Textarea::make('rejection_reason')
                        ->label('Rejection Reason')
                        ->visible(fn (Forms\Get $get) => $get('status') === 'rejected')
                        ->required(fn (Forms\Get $get) => $get('status') === 'rejected')
                        ->maxLength(1000)
                        ->rows(3),

                    Forms\Components\DateTimePicker::make('introduction_sent_at')
                        ->label('Introduction Sent At')
                        ->visible(fn (Forms\Get $get) => $get('status') === 'approved'),

                    Forms\Components\DateTimePicker::make('payment_received_at')
                        ->label('Payment Received At')
                        ->visible(fn (Forms\Get $get) => $get('payment_status') === 'paid'),
                ])
                ->columns(2),

            Forms\Components\Section::make('Request Details')
                ->schema([
                    Forms\Components\TextInput::make('service_fee')
                        ->label('Service Fee (KES)')
                        ->numeric()
                        ->default(2500.00)
                        ->required(),
                ])
                ->visible(fn ($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('requester.first_name')
                    ->label('Requester')
                    ->formatStateUsing(fn ($record) => $record->requester->first_name . ' ' . $record->requester->last_name)
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),

                Tables\Columns\TextColumn::make('requester_company')
                    ->label('Company')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('target_type')
                    ->label('Target Type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'business' => 'success',
                        'investor' => 'info',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('target_name')
                    ->label('Target')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('introduction_purpose')
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
                    ->toggleable(),

                Tables\Columns\TextColumn::make('budget_range')
                    ->label('Budget')
                    ->formatStateUsing(fn (?string $state): string => match ($state) {
                        'under_1m' => 'Under KES 1M',
                        '1m_5m' => 'KES 1M - 5M',
                        '5m_10m' => 'KES 5M - 10M',
                        '10m_50m' => 'KES 10M - 50M',
                        '50m_100m' => 'KES 50M - 100M',
                        'over_100m' => 'Over KES 100M',
                        default => 'Not specified',
                    })
                    ->toggleable(),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        'completed' => 'info',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_status')
                    ->label('Payment')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'unpaid' => 'warning',
                        'paid' => 'success',
                        'refunded' => 'danger',
                        default => 'gray',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('service_fee')
                    ->money('KES')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Requested')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('reviewed_at')
                    ->label('Reviewed')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                        'completed' => 'Completed',
                    ]),

                Tables\Filters\SelectFilter::make('target_type')
                    ->label('Target Type')
                    ->options([
                        'business' => 'Business',
                        'investor' => 'Investor',
                    ]),

                Tables\Filters\SelectFilter::make('payment_status')
                    ->label('Payment Status')
                    ->options([
                        'unpaid' => 'Unpaid',
                        'paid' => 'Paid',
                        'refunded' => 'Refunded',
                    ]),

                Tables\Filters\SelectFilter::make('introduction_purpose')
                    ->label('Purpose')
                    ->options([
                        'investment_opportunity' => 'Investment Opportunity',
                        'business_acquisition' => 'Business Acquisition',
                        'partnership' => 'Strategic Partnership',
                        'financing' => 'Business Financing',
                        'asset_purchase' => 'Asset Purchase',
                        'other' => 'Other',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),

                Tables\Actions\Action::make('approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (IntroductionRequest $record): bool => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Approve Introduction Request')
                    ->modalDescription('Are you sure you want to approve this introduction request? Both parties will be notified.')
                    ->action(function (IntroductionRequest $record) {
                        $record->update([
                            'status' => 'approved',
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                            'introduction_sent_at' => now(),
                        ]);

                        // Add notification logic here
                    })
                    ->successNotificationTitle('Introduction request approved successfully'),

                Tables\Actions\Action::make('reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->visible(fn (IntroductionRequest $record): bool => $record->status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('rejection_reason')
                            ->label('Rejection Reason')
                            ->required()
                            ->maxLength(1000)
                            ->placeholder('Please provide a reason for rejecting this request...'),
                    ])
                    ->modalHeading('Reject Introduction Request')
                    ->action(function (IntroductionRequest $record, array $data) {
                        $record->update([
                            'status' => 'rejected',
                            'rejection_reason' => $data['rejection_reason'],
                            'reviewed_by' => auth()->id(),
                            'reviewed_at' => now(),
                        ]);

                        // Add notification logic here
                    })
                    ->successNotificationTitle('Introduction request rejected'),

                Tables\Actions\Action::make('mark_completed')
                    ->icon('heroicon-o-check-badge')
                    ->color('info')
                    ->visible(fn (IntroductionRequest $record): bool => $record->status === 'approved')
                    ->requiresConfirmation()
                    ->modalHeading('Mark as Completed')
                    ->modalDescription('Mark this introduction as completed. This action cannot be undone.')
                    ->action(function (IntroductionRequest $record) {
                        $record->update([
                            'status' => 'completed',
                        ]);
                    })
                    ->successNotificationTitle('Introduction marked as completed'),

                Tables\Actions\Action::make('mark_paid')
                    ->icon('heroicon-o-currency-dollar')
                    ->color('success')
                    ->visible(fn (IntroductionRequest $record): bool =>
                        $record->payment_status === 'unpaid' && $record->status === 'approved')
                    ->requiresConfirmation()
                    ->modalHeading('Mark Payment as Received')
                    ->action(function (IntroductionRequest $record) {
                        $record->update([
                            'payment_status' => 'paid',
                            'payment_received_at' => now(),
                        ]);
                    })
                    ->successNotificationTitle('Payment marked as received'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),

                    Tables\Actions\BulkAction::make('approve_selected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function ($records) {
                            $records->where('status', 'pending')->each(function ($record) {
                                $record->update([
                                    'status' => 'approved',
                                    'reviewed_by' => auth()->id(),
                                    'reviewed_at' => now(),
                                    'introduction_sent_at' => now(),
                                ]);
                            });
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListIntroductionRequests::route('/'),
            'create' => Pages\CreateIntroductionRequest::route('/create'),
            'view' => Pages\ViewIntroductionRequest::route('/{record}'),
            'edit' => Pages\EditIntroductionRequest::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }
}