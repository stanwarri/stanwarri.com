<?php

namespace App\Filament\Widgets;

use App\Models\BookDistribution;
use App\Models\CommunityMember;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class DistributionChart extends ChartWidget
{
    protected ?string $heading = 'Distribution & Registration Trends (Last 12 Months)';

    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        $months = collect();
        for ($i = 11; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i));
        }

        $distributionData = $months->map(function ($month) {
            return BookDistribution::whereMonth('created_at', $month->month)
                ->whereYear('created_at', $month->year)
                ->count();
        });

        $registrationData = $months->map(function ($month) {
            return CommunityMember::whereMonth('registered_at', $month->month)
                ->whereYear('registered_at', $month->year)
                ->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'QR Codes Generated',
                    'data' => $distributionData->values()->toArray(),
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                ],
                [
                    'label' => 'Community Registrations',
                    'data' => $registrationData->values()->toArray(),
                    'borderColor' => 'rgb(34, 197, 94)',
                    'backgroundColor' => 'rgba(34, 197, 94, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $months->map(fn ($month) => $month->format('M Y'))->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
