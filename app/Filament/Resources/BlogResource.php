<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Filament\Resources\BlogResource\RelationManagers;
use App\Models\Blog;
use App\Models\BlogCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;

class BlogResource extends Resource
{

    protected static ?string $recordTitleAttribute = 'title';

    public static function getGloballySearchableAttributes(): array
    {
        return ['title', 'slug', 'status', 'category.name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Title' => $record->title,
            'Category' => $record->category->name,
            'Excerpt' => Str::limit(strip_tags($record->excerpt), 100),
        ];
    }

    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'icon-newspaper';

    protected static ?string $navigationGroup = 'Resources';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->unique(ignoreRecord: true),
                Forms\Components\FileUpload::make('featured_image')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->previewable()
                    ->maxSize(2048)
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->columnSpanFull()
                    ->searchable()
                    ->createOptionModalHeading('Create Blog Category')
                    ->createOptionForm(function () {
                        return [
                            Forms\Components\TextInput::make('name')
                                ->required(),
                        ];
                    })
                    ->relationship('category', 'name')
                    ->options(BlogCategory::all()->pluck('name', 'id')->toArray())
                    ->createOptionUsing(fn($data) => BlogCategory::create($data))
                    ->required(),
                Forms\Components\RichEditor::make('excerpt')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(fn($record) => $record->title)
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('excerpt')
                    ->searchable()
                    ->html()
                    ->limit(40)
                    ->tooltip(fn($record) => new HtmlString($record->excerpt))
                    ->wrap()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->searchable()
                    ->label('Created On')
                    ->dateTime('M d, Y')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn($record) => match ($record->status) {
                        'draft' => 'danger',
                        'published' => 'success',
                    })
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('icon-pen-line'),
            ])
            ->emptyStateHeading('No Blogs Yet')
            ->emptyStateDescription('Click the button above to create your first blog.')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->failureNotificationTitle('An error occurred while deleting the selected blogs. Please try again.')
                        ->successNotificationTitle('The selected blogs were deleted')
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
            'index' => Pages\ListBlogs::route('/'),
            'create' => Pages\CreateBlog::route('/create'),
            'edit' => Pages\EditBlog::route('/{record}/edit'),
        ];
    }
}
