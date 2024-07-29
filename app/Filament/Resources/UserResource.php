<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Role;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'icon-user';

    protected static ?string $navigationGroup = 'Administration';

    protected static ?string $modelLabel = 'System Users';

    protected static ?int $navigationSort= 1;

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
                    Forms\Components\Select::make('registration_type')
                    ->label('Registration type')
                    ->options(Role::all()->pluck('name', 'name'))
                    ->searchable()->preload(),
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
                Tables\Columns\TextColumn::make('registration_type'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->icon('pen-line'),
                Tables\Actions\DeleteAction::make()

            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make()
                //         ->requiresConfirmation()
                // ]),
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
