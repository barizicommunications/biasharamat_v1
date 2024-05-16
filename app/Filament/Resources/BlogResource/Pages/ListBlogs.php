<?php

namespace App\Filament\Resources\BlogResource\Pages;

use App\Filament\Resources\BlogResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListBlogs extends ListRecords
{
    protected static string $resource = BlogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Create Blog')
                ->icon('icon-pen-line')
        ];
    }

    public function getTabs(): array
    {
        return [
            Tab::make('All')
                ->icon('icon-list'),
            Tab::make('Published')
                ->icon('icon-list-checks')
                ->modifyQueryUsing(fn(Builder $query) => $query->published()->latest()),
            Tab::make('Drafts')
                ->icon('icon-layout-list')
                ->modifyQueryUsing(fn(Builder $query) => $query->drafts()->latest()),
        ];
    }
}
