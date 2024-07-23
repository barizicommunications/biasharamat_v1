<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'icon-user';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?string $modelLabel = 'System Users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('first_name')
                    ->required(),
                Forms\Components\TextInput::make('last_name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->unique(ignoreRecord: true)
                    ->required(),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->autocomplete('new-password')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fullname')
                    ->sortable()
                    ->searchable(query: fn(Builder $query, $search) => $query->orWhere('first_name', 'like', "%{$search}%")->orWhere('last_name', 'like', "%{$search}%")),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->tooltip('Click to email this user')
                    ->sortable()
                    ->url(fn($record) => "mailto:{$record->email}"),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('pen-line')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->requiresConfirmation()
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     return User::query()->where('registration_type', 'Business Buyer');
    // }
}
