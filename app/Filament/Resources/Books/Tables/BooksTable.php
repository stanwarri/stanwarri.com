<?php

namespace App\Filament\Resources\Books\Tables;

use App\Models\BookDistribution;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
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
                    ->state(fn($record) => $record->remaining_quantity)
                    ->color(fn($state) => $state > 0 ? 'success' : 'danger'),
                
                TextColumn::make('purchase_date')
                    ->date()
                    ->sortable(),
                
                TextColumn::make('purchase_price')
                    ->money('USD')
                    ->sortable(),
            ])
            ->filters([
                //
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
                            ->default(fn($record) => $record->remaining_quantity)
                            ->minValue(1)
                            ->maxValue(fn($record) => $record->remaining_quantity)
                            ->helperText(fn($record) => "Remaining quantity: {$record->remaining_quantity}"),
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
                    ->visible(fn($record) => $record->remaining_quantity > 0),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
