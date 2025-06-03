<?php

namespace App\Filament\Resources\IntroductionRequestResource\Pages;

use App\Filament\Resources\IntroductionRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListIntroductionRequests extends ListRecords
{
    protected static string $resource = IntroductionRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Don't include create action since requests are submitted from frontend
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All Requests')
                ->badge(fn () => $this->getModel()::count()),

            'pending' => Tab::make('Pending')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'pending'))
                ->badge(fn () => $this->getModel()::where('status', 'pending')->count())
                ->badgeColor('warning'),

            'approved' => Tab::make('Approved')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'approved'))
                ->badge(fn () => $this->getModel()::where('status', 'approved')->count())
                ->badgeColor('success'),

            'rejected' => Tab::make('Rejected')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'rejected'))
                ->badge(fn () => $this->getModel()::where('status', 'rejected')->count())
                ->badgeColor('danger'),

            'completed' => Tab::make('Completed')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'completed'))
                ->badge(fn () => $this->getModel()::where('status', 'completed')->count())
                ->badgeColor('info'),

            'unpaid' => Tab::make('Unpaid')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('payment_status', 'unpaid'))
                ->badge(fn () => $this->getModel()::where('payment_status', 'unpaid')->count())
                ->badgeColor('warning'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // Add widgets here if needed
        ];
    }
}