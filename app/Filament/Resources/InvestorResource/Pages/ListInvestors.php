<?php

namespace App\Filament\Resources\InvestorResource\Pages;

use App\Filament\Resources\InvestorResource;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListInvestors extends ListRecords
{
    protected static string $resource = InvestorResource::class;

//    protected function getHeaderActions(): array
//    {
//        return [
//            Actions\CreateAction::make(),
//        ];
//    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'verified' => Tab::make()
                ->label('Verified Sellers')
                ->icon('icon-badge-check')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNotNull('verified_at')),
            'unverified' => Tab::make()
                ->icon('icon-badge-x')
                ->label('Unverified Sellers')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereNull('verified_at')),
        ];
    }
}
