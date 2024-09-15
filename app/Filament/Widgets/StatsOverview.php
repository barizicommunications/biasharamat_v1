<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\BusinessProfile;
use App\Models\InvestorProfile;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;
    protected function getStats(): array
    {
        return [
            Stat::make('Registred users', User::all()->count())->url('/admin/users')
            ->description('view all users')
            ->descriptionIcon('heroicon-m-arrow-long-right')
            ->color('success'),
            Stat::make('Registered Business Owner', BusinessProfile::all()->count())->url('/admin/business-profiles')
            ->description('view all Business Owner')
            ->descriptionIcon('heroicon-m-arrow-long-right')
            ->color('success'),
            Stat::make('Registered Investors',InvestorProfile::all()->count())->url('/admin/investor-profiles')
            ->description('view all investors')
            ->descriptionIcon('heroicon-m-arrow-long-right')
            ->color('success'),
        ];
    }
}
