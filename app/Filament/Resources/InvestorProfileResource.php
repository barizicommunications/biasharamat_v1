<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvestorProfileResource\Pages;
use App\Filament\Resources\InvestorProfileResource\RelationManagers;
use App\Models\InvestorProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvestorProfileResource extends Resource
{
    protected static ?string $model = InvestorProfile::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Manage user profiles';
    protected static ?int $navigationSort= 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mobile_number')
                    ->required()
                    ->maxLength(15),
                Forms\Components\TextInput::make('interested_in')
                    ->required(),
                Forms\Components\TextInput::make('buyer_role')
                    ->required(),
                Forms\Components\TextInput::make('buyer_interest')
                    ->required(),
                Forms\Components\TextInput::make('buyer_location_interest')
                    ->required(),
                Forms\Components\TextInput::make('investment_range')
                    ->required()
                    ->numeric()
                    ->default(0.00),
                Forms\Components\TextInput::make('current_location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('company_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('linkedin_profile')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('website_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('business_factors')
                    ->required()
                    ->maxLength(1000),
                Forms\Components\TextInput::make('about_company')
                    ->required()
                    ->maxLength(1000),
                Forms\Components\TextInput::make('corporate_profile')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('company_logo')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('proof_of_business')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('terms_of_engagement')
                    ->required()
                    ->maxLength(255)
                    ->default('off'),
                Forms\Components\TextInput::make('active_business')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile_number')
                    ->searchable(),

                Tables\Columns\TextColumn::make('company_name'),
                Tables\Columns\TextColumn::make('verification_status')
                    ->searchable(),



                Tables\Columns\TextColumn::make('active_business'),
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
            'index' => Pages\ListInvestorProfiles::route('/'),
            'create' => Pages\CreateInvestorProfile::route('/create'),
            'view' => Pages\ViewInvestor::route('/{record}'),
            'edit' => Pages\EditInvestorProfile::route('/{record}/edit'),
        ];
    }
}
