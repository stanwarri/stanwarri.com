<?php

namespace App\Filament\Resources\BookDistributions\Tables;

use App\Filament\Exports\BookDistributionExporter;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookDistributionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('book.title')
                    ->label('Book Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('book.author')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),

                ImageColumn::make('qr_image')
                    ->label('QR Code')
                    ->height(60)
                    ->width(60),

                TextColumn::make('qr_code')
                    ->label('QR Code Text')
                    ->searchable()
                    ->copyable()
                    ->limit(15),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'distributed' => 'warning',
                        'registered' => 'success',
                    }),

                TextColumn::make('distribution_date')
                    ->label('Distribution Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('distribution_location')
                    ->label('Location')
                    ->limit(30),

                TextColumn::make('communityMember.name')
                    ->label('Registered By')
                    ->placeholder('Not registered')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'distributed' => 'Distributed',
                        'registered' => 'Registered',
                    ]),

                SelectFilter::make('book_id')
                    ->label('Book')
                    ->relationship('book', 'title')
                    ->searchable()
                    ->preload(),

                Filter::make('distribution_date_range')
                    ->form([
                        TextInput::make('from')
                            ->type('date')
                            ->label('Distribution Date From'),
                        TextInput::make('until')
                            ->type('date')
                            ->label('Distribution Date Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn (Builder $query, $date): Builder => $query->whereDate('distribution_date', '>=', $date))
                            ->when($data['until'], fn (Builder $query, $date): Builder => $query->whereDate('distribution_date', '<=', $date));
                    }),

                Filter::make('has_registration')
                    ->label('Registration Status')
                    ->query(function (Builder $query): Builder {
                        return $query->whereHas('communityMember');
                    })
                    ->toggle(),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('print_qr')
                    ->label('Print QR Code')
                    ->icon('heroicon-o-printer')
                    ->url(fn ($record) => route('qr.print', $record->qr_code))
                    ->openUrlInNewTab(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(BookDistributionExporter::class),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
