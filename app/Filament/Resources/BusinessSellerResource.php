<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessSellerResource\Pages;
use App\Filament\Resources\BusinessSellerResource\RelationManagers;
use App\Models\BusinessSeller;
use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BusinessSellerResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'icon-store';

    protected static ?string $modelLabel = 'Business Seller';

    protected static ?string $navigationGroup = 'User Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBusinessSellers::route('/'),
            'create' => Pages\CreateBusinessSeller::route('/create'),
            'edit' => Pages\EditBusinessSeller::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return User::query()
            ->where('registration_type', 'Business Seller');
    }
}
