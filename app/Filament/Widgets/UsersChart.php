<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class UsersChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        // Get registered users grouped by month
    $usersByMonth = User::select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
    ->groupBy('month')
    ->get();

// Convert data to the desired format
$data = [];
$labels = [];
foreach ($usersByMonth as $user) {
    $monthName = Carbon::create(now()->year, $user->month)->format('M');
    $data[] = $user->count;
    $labels[] = $monthName;
}
return [
    'datasets' => [
        [
            'label' => 'Registered Users',
            'data' => $data,
        ],
    ],
    'labels' => $labels,
];
    }

    protected function getType(): string
    {
        return 'bar';
    }


}
