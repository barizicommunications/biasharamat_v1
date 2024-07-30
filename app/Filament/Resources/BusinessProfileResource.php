<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessProfileResource\Pages;
use App\Filament\Resources\BusinessProfileResource\RelationManagers;
use App\Models\BusinessProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                // Forms\Components\TextInput::make('user_id')
                //     ->required()
                //     ->numeric(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('company_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('mobile_number')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('display_company_details')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('seller_role')
                    ->required(),
                Forms\Components\TextInput::make('seller_interest')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('business_start_date')
                    ->required(),
                Forms\Components\TextInput::make('business_industry')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('city')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('county')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('number_employees')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('business_legal_entity')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('website_link')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('business_description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('product_services')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('business_highlights')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('facility_description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('business_funds')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('number_shareholders')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('monthly_turnover')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('yearly_turnover')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('profit_margin')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tangible_assets')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('liabilities')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('physical_assets')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('interested_in_quotations')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('business_photos')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('information_memorandum')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('financial_report')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('valuation_worksheets')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('active_business')
                    ->maxLength(255)
                    ->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile_number')
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
