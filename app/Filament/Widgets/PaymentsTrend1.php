<?php

namespace App\Filament\Widgets;

use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class PaymentsTrend extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    // protected static string $chartId = 'paymentsTrend';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Payments Trend';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            'chart' => [
                'type' => 'bar',
                'height' => 400,
            ],
            'series' => [
                [
                    'name' => 'Payments Trend',
                    'data' => [7, 10, 13, 15, 18, 20, 22, 25, 28, 30, 32, 35],
                ],
            ],
            'xaxis' => [
                'categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => true,
                ],
            ],
        ];
    }
}
