<?php

namespace App\Filament\Exports;

use App\Models\BookDistribution;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class BookDistributionExporter extends Exporter
{
    protected static ?string $model = BookDistribution::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('book.title')->label('Book Title'),
            ExportColumn::make('book.author')->label('Book Author'),
            ExportColumn::make('qr_code')->label('QR Code'),
            ExportColumn::make('status'),
            ExportColumn::make('distribution_date')->label('Distribution Date'),
            ExportColumn::make('distribution_location')->label('Distribution Location'),
            ExportColumn::make('communityMember.name')->label('Registered By'),
            ExportColumn::make('communityMember.email')->label('Member Email'),
            ExportColumn::make('notes'),
            ExportColumn::make('created_at')->label('Created At'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your book distribution export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
