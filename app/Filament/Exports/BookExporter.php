<?php

namespace App\Filament\Exports;

use App\Models\Book;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class BookExporter extends Exporter
{
    protected static ?string $model = Book::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('title'),
            ExportColumn::make('author'),
            ExportColumn::make('isbn')->label('ISBN'),
            ExportColumn::make('description'),
            ExportColumn::make('purchase_date')->label('Purchase Date'),
            ExportColumn::make('purchase_price')->label('Purchase Price'),
            ExportColumn::make('quantity_purchased')->label('Quantity Purchased'),
            ExportColumn::make('distributions_count')->label('Distributed Count')
                ->state(fn (Book $record): int => $record->distributions()->count()),
            ExportColumn::make('remaining_quantity')->label('Remaining Stock')
                ->state(fn (Book $record): int => $record->remaining_quantity),
            ExportColumn::make('created_at')->label('Created At'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your book export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
