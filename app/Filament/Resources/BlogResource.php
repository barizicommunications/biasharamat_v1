<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Blog;
use Filament\Tables;
use App\Models\Author;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BlogResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BlogResource\RelationManagers;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'Manage blogs';
    protected static ?int $navigationSort= 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('slug')
                ->required()
                ->maxLength(255)
                ->hidden(),
                Forms\Components\Select::make('category_id')
                ->required()
                ->label('Category')
                ->options(function(){
                    return Category::all()
                    ->pluck('category_name', 'id');
                })
                ->preload()
                ->reactive()
                ->createOptionForm([
                    TextInput::make('category_name')
                    ->required()
                    ->autofocus()
                    ->placeholder('Enter category name'),

        ])
                ->createOptionUsing(function(array $data){
                  $category =  Category::updateOrCreate( [
                        'category_name' => $data['category_name'],

                    ]);

                    Notification::make('Add category')
                        ->success()
                        ->title('Success')
                        ->body('Category added successfully')
                        ->send();


                }),

                TagsInput::make('tags')
                ->label('Tags')
                ->placeholder('Add one or multiple tags'),
                TagsInput::make('keywords')
                ->label('Keywords')
                ->placeholder('Add one or multiple keywords'),



            Forms\Components\Textarea::make('excerpt')
                ->required()
                ->maxLength(65535)
                ->columnSpanFull(),
            // Forms\Components\TextInput::make('tags'),
            Forms\Components\FileUpload::make('featured_image')
                ->image()
                ->required()
                ->maxSize(1024)
                ->columnSpanFull()
                ,
            Forms\Components\RichEditor::make('body')
                ->required()->columnSpan('full')
                ,
                Forms\Components\Select::make('author_id')
                ->required()
                ->label('Author')
                ->options(function(){
                    return Author::all()
                    ->pluck('author_name', 'id');
                })
                ->preload()
                ->reactive()
                ->createOptionForm([
                    TextInput::make('author_name')
                    ->required()
                    ->autofocus()
                    ->placeholder('Enter author name'),


        ])
                ->createOptionUsing(function(array $data){
                  $author =  Author::updateOrCreate( [
                        'author_name' => $data['author_name'],

                    ]);

                    Notification::make('Add author')
                        ->success()
                        ->title('Success')
                        ->body('Author added successfully')
                        ->send();


                }),
                Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'reviewing' => 'Reviewing',
                    'published' => 'Published',
                ])->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('category_id')
                ->label('Category name')
                ->getStateUsing(function (Blog $record){
                    $category = Category::where('id',$record->category_id)->pluck('category_name')->first();
                    return $category;
                }),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
