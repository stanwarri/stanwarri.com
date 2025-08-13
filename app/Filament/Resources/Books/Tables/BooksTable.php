<?php

namespace App\Filament\Resources\Books\Tables;

use App\Filament\Exports\BookExporter;
use App\Models\BookDistribution;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Actions\BulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image_url')
                    ->label('Cover')
                    ->height(60)
                    ->defaultImageUrl('/images/book-placeholder.png'),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('author')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('quantity_purchased')
                    ->label('Qty Purchased')
                    ->sortable(),

                TextColumn::make('distributions_count')
                    ->label('Distributed')
                    ->counts('distributions')
                    ->sortable(),

                TextColumn::make('remaining_quantity')
                    ->label('Remaining')
                    ->state(fn ($record) => $record->remaining_quantity)
                    ->color(fn ($state) => $state > 0 ? 'success' : 'danger'),

                TextColumn::make('purchase_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('purchase_price')
                    ->money('USD')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('has_stock')
                    ->label('Stock Status')
                    ->options([
                        'available' => 'Available Stock',
                        'out_of_stock' => 'Out of Stock',
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? null) {
                            'available' => $query->whereColumn('quantity_purchased', '>', 'distributions_count'),
                            'out_of_stock' => $query->whereColumn('quantity_purchased', '<=', 'distributions_count'),
                            default => $query,
                        };
                    }),

                Filter::make('purchase_date_range')
                    ->form([
                        TextInput::make('from')
                            ->type('date')
                            ->label('Purchase Date From'),
                        TextInput::make('until')
                            ->type('date')
                            ->label('Purchase Date Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn (Builder $query, $date): Builder => $query->whereDate('purchase_date', '>=', $date))
                            ->when($data['until'], fn (Builder $query, $date): Builder => $query->whereDate('purchase_date', '<=', $date));
                    }),

                Filter::make('price_range')
                    ->form([
                        TextInput::make('min_price')
                            ->numeric()
                            ->prefix('$')
                            ->label('Minimum Price'),
                        TextInput::make('max_price')
                            ->numeric()
                            ->prefix('$')
                            ->label('Maximum Price'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['min_price'], fn (Builder $query, $price): Builder => $query->where('purchase_price', '>=', $price))
                            ->when($data['max_price'], fn (Builder $query, $price): Builder => $query->where('purchase_price', '<=', $price));
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('generate_qr_codes')
                    ->label('Generate QR Codes')
                    ->icon('heroicon-o-qr-code')
                    ->form([
                        TextInput::make('quantity')
                            ->label('Quantity to Generate')
                            ->numeric()
                            ->required()
                            ->default(fn ($record) => $record->remaining_quantity)
                            ->minValue(1)
                            ->maxValue(fn ($record) => $record->remaining_quantity)
                            ->helperText(fn ($record) => "Remaining quantity: {$record->remaining_quantity}"),
                    ])
                    ->action(function (array $data, $record): void {
                        $quantity = $data['quantity'];

                        for ($i = 0; $i < $quantity; $i++) {
                            BookDistribution::create([
                                'book_id' => $record->id,
                                'qr_code' => Str::random(20),
                                'status' => 'pending',
                            ]);
                        }

                        Notification::make()
                            ->title("Generated {$quantity} QR codes")
                            ->success()
                            ->send();
                    })
                    ->visible(fn ($record) => $record->remaining_quantity > 0),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(BookExporter::class),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('bulk_generate_qr')
                        ->label('Generate QR Codes')
                        ->icon('heroicon-o-qr-code')
                        ->form([
                            TextInput::make('quantity_per_book')
                                ->label('QR Codes per Book')
                                ->numeric()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->maxValue(50)
                                ->helperText('Number of QR codes to generate for each selected book'),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $totalGenerated = 0;
                            $quantity = $data['quantity_per_book'];

                            foreach ($records as $book) {
                                $remaining = $book->remaining_quantity;
                                $toGenerate = min($quantity, $remaining);

                                if ($toGenerate > 0) {
                                    for ($i = 0; $i < $toGenerate; $i++) {
                                        BookDistribution::create([
                                            'book_id' => $book->id,
                                            'qr_code' => Str::random(20),
                                            'status' => 'pending',
                                        ]);
                                    }
                                    $totalGenerated += $toGenerate;
                                }
                            }

                            Notification::make()
                                ->title("Generated {$totalGenerated} QR codes")
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    BulkAction::make('bulk_update_price')
                        ->label('Update Prices')
                        ->icon('heroicon-o-currency-dollar')
                        ->form([
                            Select::make('price_action')
                                ->label('Price Action')
                                ->options([
                                    'set' => 'Set to specific amount',
                                    'increase' => 'Increase by amount',
                                    'decrease' => 'Decrease by amount',
                                    'multiply' => 'Multiply by factor',
                                ])
                                ->required(),
                            TextInput::make('price_value')
                                ->label('Value')
                                ->numeric()
                                ->required()
                                ->step(0.01)
                                ->helperText('Amount or factor depending on action selected'),
                        ])
                        ->action(function (Collection $records, array $data): void {
                            $action = $data['price_action'];
                            $value = (float) $data['price_value'];
                            $updated = 0;

                            foreach ($records as $book) {
                                $currentPrice = (float) $book->purchase_price;
                                $newPrice = match ($action) {
                                    'set' => $value,
                                    'increase' => $currentPrice + $value,
                                    'decrease' => max(0, $currentPrice - $value),
                                    'multiply' => $currentPrice * $value,
                                };

                                $book->update(['purchase_price' => $newPrice]);
                                $updated++;
                            }

                            Notification::make()
                                ->title("Updated prices for {$updated} books")
                                ->success()
                                ->send();
                        })
                        ->deselectRecordsAfterCompletion(),

                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
