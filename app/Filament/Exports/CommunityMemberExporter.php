<?php

namespace App\Filament\Exports;

use App\Models\CommunityMember;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class CommunityMemberExporter extends Exporter
{
    protected static ?string $model = CommunityMember::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('name'),
            ExportColumn::make('email'),
            ExportColumn::make('phone'),
            ExportColumn::make('bookDistribution.book.title')->label('Book Title'),
            ExportColumn::make('bookDistribution.book.author')->label('Book Author'),
            ExportColumn::make('how_found')->label('How Found'),
            ExportColumn::make('message'),
            ExportColumn::make('interests')
                ->state(fn (CommunityMember $record): string => is_array($record->interests)
                        ? implode(', ', $record->interests)
                        : (string) $record->interests
                ),
            ExportColumn::make('registered_at')->label('Registered At'),
            ExportColumn::make('created_at')->label('Created At'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your community member export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
