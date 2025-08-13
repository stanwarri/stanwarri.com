<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\BookDistribution;
use App\Models\CommunityMember;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DistributionOverviewWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalBooks = Book::count();
        $totalDistributions = BookDistribution::count();
        $totalMembers = CommunityMember::count();
        $registeredDistributions = BookDistribution::where('status', 'registered')->count();
        $pendingDistributions = BookDistribution::where('status', 'pending')->count();
        $distributedButNotRegistered = BookDistribution::where('status', 'distributed')->count();

        $totalBooksPurchased = Book::sum('quantity_purchased');
        $remainingBooks = $totalBooksPurchased - $totalDistributions;

        $totalMoneySpent = Book::sum('purchase_price');
        $averageBookPrice = $totalBooks > 0 ? $totalMoneySpent / $totalBooksPurchased : 0;

        $registrationRate = $totalDistributions > 0 ? ($registeredDistributions / $totalDistributions) * 100 : 0;

        return [
            Stat::make('Total Books', $totalBooks)
                ->description('Unique book titles')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),

            Stat::make('Books Distributed', $totalDistributions)
                ->description('QR codes generated')
                ->descriptionIcon('heroicon-m-qr-code')
                ->color('info'),

            Stat::make('Community Members', $totalMembers)
                ->description('Registered users')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Registration Rate', number_format($registrationRate, 1).'%')
                ->description('Distribution to registration ratio')
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($registrationRate > 50 ? 'success' : ($registrationRate > 25 ? 'warning' : 'danger')),

            Stat::make('Remaining Stock', $remainingBooks)
                ->description('Books not yet distributed')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color($remainingBooks > 10 ? 'success' : ($remainingBooks > 0 ? 'warning' : 'danger')),

            Stat::make('Total Investment', '$'.number_format($totalMoneySpent, 2))
                ->description('Money spent on books')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('info'),
        ];
    }
}
